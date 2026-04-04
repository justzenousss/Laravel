<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(5);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'credits' => 'required|integer|min:1|max:10'
        ], [
            'name.required' => 'Tên môn học không được để trống.',
            'name.min' => 'Tên môn học phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên môn học không được vượt quá 100 ký tự.',
            'credits.required' => 'Số tín chỉ không được để trống.',
            'credits.integer' => 'Số tín chỉ phải là số nguyên.',
            'credits.min' => 'Số tín chỉ phải lớn hơn hoặc bằng 1.',
            'credits.max' => 'Số tín chỉ không hợp lệ.'
        ]);

        Course::create([
            'name' => $request->name,
            'credits' => $request->credits
        ]);

        return redirect()->route('courses.index')->with('success', 'Thêm môn học thành công!');
    }

    public function show(string $id)
    {
        return redirect()->route('courses.index');
    }

    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'name' => 'required|min:2|max:100',
            'credits' => 'required|integer|min:1|max:10'
        ], [
            'name.required' => 'Tên môn học không được để trống.',
            'name.min' => 'Tên môn học phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên môn học không được vượt quá 100 ký tự.',
            'credits.required' => 'Số tín chỉ không được để trống.',
            'credits.integer' => 'Số tín chỉ phải là số nguyên.',
            'credits.min' => 'Số tín chỉ phải lớn hơn hoặc bằng 1.',
            'credits.max' => 'Số tín chỉ không hợp lệ.'
        ]);

        $course->update([
            'name' => $request->name,
            'credits' => $request->credits
        ]);

        return redirect()->route('courses.index')->with('success', 'Cập nhật môn học thành công!');
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Xóa môn học thành công!');
    }
}