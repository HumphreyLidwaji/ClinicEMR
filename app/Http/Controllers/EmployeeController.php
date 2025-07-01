<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'nullable|email|unique:employees',
    ]);

    // Get hospital code from .env
    $hospitalCode = env('HOSPITAL_CODE', 'HOS');

    // Get the next ID (soft-deleted included)
    $lastEmployee = Employee::withTrashed()->orderByDesc('id')->first();
    $nextNumber = ($lastEmployee?->id ?? 0) + 1;

    // Format: KSC-EMP-0001
    $employeeNumber = $hospitalCode . '-EMP-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    // Merge and create
    $data = $request->all();
    $data['employee_number'] = $employeeNumber;

    Employee::create($data);

    return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
}


    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            //'employee_number' => 'required|unique:employees,employee_number,' . $employee->id,
            'email' => 'nullable|email|unique:employees,email,' . $employee->id,
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted.');
    }
}
