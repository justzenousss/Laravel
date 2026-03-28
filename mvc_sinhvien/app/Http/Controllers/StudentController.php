<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
{
    $keyword = $request->input('keyword');

    if ($keyword) {
        $students = Student::where('name', 'like', '%' . $keyword . '%')->get();
    } else {
        $students = Student::all();
    }

    return view('students.index', compact('students', 'keyword'));
}

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
{
    $request->validate(
        [
            'name' => ['required', 'min:3', 'regex:/^[\pL\s]+$/u'],
            'major' => 'required'
        ],
        [
            'name.required' => 'Tên không được để trống',
            'name.min' => 'Tên phải có ít nhất 3 ký tự',
            'name.regex' => 'Tên không được chứa số hoặc ký tự đặc biệt',
            'major.required' => 'Ngành học không được để trống'
        ]
    );

    
    Student::create($request->all());

    return redirect('/');
}
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'major' => 'required'
        ]);

        Student::findOrFail($id)->update($request->all());

        return redirect('/');
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return redirect('/');
    }
}