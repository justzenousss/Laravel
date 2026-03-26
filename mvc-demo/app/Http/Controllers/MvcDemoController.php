<?php

namespace App\Http\Controllers;

use App\Models\Student;

class MvcDemoController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students', compact('students'));
    }
}