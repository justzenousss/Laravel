<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmp = Employee::count();
        $totalDep = Department::count();
        $newEmp = Employee::latest()->take(5)->get();

        return view('dashboard', compact('totalEmp', 'totalDep', 'newEmp'));
    }
}