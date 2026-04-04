<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
{
    $keyword = $request->keyword;
    $sort = $request->sort ?? 'asc';

    $students = Student::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->orderByRaw("SUBSTRING_INDEX(name, ' ', -1) $sort")
        ->orderBy('name', $sort)
        ->paginate(5)
        ->appends([
            'keyword' => $keyword,
            'sort' => $sort
        ]);

    return view('students.index', compact('students', 'keyword', 'sort'));
}

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|regex:/^[\pL\s]+$/u',
            'major' => 'required|min:2|max:100',
            'email' => 'required|email|unique:students,email'
        ], [
            'name.required' => 'Tên không được để trống.',
            'name.min' => 'Tên phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên không được vượt quá 100 ký tự.',
            'name.regex' => 'Tên không được chứa số hoặc ký tự đặc biệt.',
            'major.required' => 'Ngành không được để trống.',
            'major.min' => 'Ngành phải có ít nhất 2 ký tự.',
            'major.max' => 'Ngành không được vượt quá 100 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.'
        ]);

        Student::create([
            'name' => $request->name,
            'major' => $request->major,
            'email' => $request->email
        ]);

        return redirect()->route('students.index')->with('success', 'Thêm sinh viên thành công!');
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
            'name' => 'required|min:2|max:100|regex:/^[\pL\s]+$/u',
            'major' => 'required|min:2|max:100',
            'email' => 'required|email|unique:students,email,' . $student->id
        ], [
            'name.required' => 'Tên không được để trống.',
            'name.min' => 'Tên phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên không được vượt quá 100 ký tự.',
            'name.regex' => 'Tên không được chứa số hoặc ký tự đặc biệt.',
            'major.required' => 'Ngành không được để trống.',
            'major.min' => 'Ngành phải có ít nhất 2 ký tự.',
            'major.max' => 'Ngành không được vượt quá 100 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.'
        ]);

        $student->update([
            'name' => $request->name,
            'major' => $request->major,
            'email' => $request->email
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