<?php
namespace App\Http\Controllers\Department;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;


class DepartmentController extends Controller
{
public function index()
{
    $departments = Department::all();
    return view('departments.index', compact('departments'));
}

public function create()
{
    return view('departments.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:departments',
        'description' => 'nullable|string'
    ]);

    Department::create($request->all());
    return redirect()->route('departments.index')->with('success', 'Department created.');
}

public function edit(Department $department)
{
    return view('departments.edit', compact('department'));
}

public function update(Request $request, Department $department)
{
    $request->validate([
        'name' => 'required|unique:departments,name,' . $department->id,
        'description' => 'nullable|string'
    ]);

    $department->update($request->all());
    return redirect()->route('departments.index')->with('success', 'Department updated.');
}

public function destroy(Department $department)
{
    $department->delete();
    return redirect()->route('departments.index')->with('success', 'Department deleted.');
}

}