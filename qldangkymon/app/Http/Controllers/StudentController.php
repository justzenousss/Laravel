<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100'
        ], [
            'name.required' => 'Tên sinh viên không được để trống.',
            'name.min' => 'Tên sinh viên phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên sinh viên không được vượt quá 100 ký tự.'
        ]);

        Student::create([
            'name' => $request->name
        ]);

        return redirect()->route('students.index')->with('success', 'Thêm sinh viên thành công!');
    }

    public function show(string $id)
    {
        return redirect()->route('students.index');
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|min:2|max:100'
        ], [
            'name.required' => 'Tên sinh viên không được để trống.',
            'name.min' => 'Tên sinh viên phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên sinh viên không được vượt quá 100 ký tự.'
        ]);

        $student->update([
            'name' => $request->name
        ]);

        return redirect()->route('students.index')->with('success', 'Cập nhật sinh viên thành công!');
    }

    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Xóa sinh viên thành công!');
    }
}