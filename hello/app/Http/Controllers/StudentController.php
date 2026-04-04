<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('id', 'asc')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|regex:/^[\pL\s]+$/u',
            'major' => 'required|min:1'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Thêm thành công!');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|regex:/^[\pL\s]+$/u',
            'major' => 'required|min:1'
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Cập nhật thành công!');
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa!');
    }
}