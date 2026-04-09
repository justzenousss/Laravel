<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim((string) $request->query('q', ''));

        $employees = Employee::query()
            ->with('department')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhere('position', 'like', "%{$keyword}%")
                        ->orWhereHas('department', function ($departmentQuery) use ($keyword) {
                            $departmentQuery->where('name', 'like', "%{$keyword}%");
                        });
                });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('employees.index', [
            'employees' => $employees,
            'keyword' => $keyword,
        ]);
    }

    public function create()
    {
        return view('employees.create', [
            'departments' => Department::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Employee::create($this->validateEmployee($request));

        return redirect()
            ->route('employees.index')
            ->with('success', 'Them nhan vien thanh cong.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', [
            'employee' => $employee->load('department'),
        ]);
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'departments' => Department::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($this->validateEmployee($request, $employee));

        return redirect()
            ->route('employees.index')
            ->with('success', 'Cap nhat nhan vien thanh cong.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Xoa nhan vien thanh cong.');
    }

    private function validateEmployee(Request $request, ?Employee $employee = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => [
                'required',
                'email',
                'max:120',
                Rule::unique('employees', 'email')->ignore($employee?->id),
            ],
            'position' => ['required', 'string', 'max:120'],
            'department_id' => ['nullable', 'exists:departments,id'],
        ]);
    }
}
