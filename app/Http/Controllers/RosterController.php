<?php

namespace App\Http\Controllers;
use App\Models\Roster;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;

class RosterController extends Controller
{
public function index(Request $request)
{
    $selectedMonth = $request->input('month', now()->month);
    $selectedYear = $request->input('year', now()->year);

    $employees = Employee::all();
    $rosters = Roster::whereMonth('shift_date', $selectedMonth)
                     ->whereYear('shift_date', $selectedYear)
                     ->get();

    $departments = Employee::distinct()->pluck('department');

    return view('rosters.index', compact('employees', 'rosters', 'departments', 'selectedMonth', 'selectedYear'));
}


    public function create()
    {
        $employees = Employee::where('is_active', 1)->get();
        return view('rosters.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'shift_date' => 'required|date',
            'shift' => 'required|string',
        ]);

        Roster::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
                'shift_date' => $request->shift_date,
            ],
            [
                'shift' => $request->shift,
            ]
        );

        return redirect()->route('rosters.index')->with('success', 'Roster updated.');
    }

    public function edit(Roster $roster)
    {
        $employees = Employee::where('is_active', 1)->get();
        return view('rosters.edit', compact('roster', 'employees'));
    }

    public function update(Request $request, Roster $roster)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'shift_date' => 'required|date',
            'shift' => 'required|string',
        ]);

        $roster->update($request->all());

        return redirect()->route('rosters.index')->with('success', 'Roster updated.');
    }

    public function destroy(Roster $roster)
    {
        $roster->delete();
        return redirect()->route('rosters.index')->with('success', 'Roster deleted.');
    }

    public function bulkAssign(Request $request)
{
    $assignments = $request->input('assignments', []);

    foreach ($assignments as $employeeId => $dates) {
        foreach ($dates as $date => $value) {
            // Check if a roster entry exists for this employee & date
            $roster = Roster::where('employee_id', $employeeId)
                            ->where('shift_date', $date)
                            ->first();

            if ($value) {
                // If checkbox checked and roster doesn't exist, create it
                if (!$roster) {
                    Roster::create([
                        'employee_id' => $employeeId,
                        'shift_date' => $date,
                        'shift' => 'Morning', // Or default shift you want
                    ]);
                }
            } else {
                // If checkbox not checked and roster exists, delete it
                if ($roster) {
                    $roster->delete();
                }
            }
        }
    }

    return redirect()->route('rosters.index')->with('success', 'Roster updated successfully.');
}

public function printByDepartment(Request $request)
{
    $department = $request->input('department');

    $employees = Employee::where('department', $department)->get();
    $rosters = Roster::whereIn('employee_id', $employees->pluck('id'))->get();

    return view('rosters.print', compact('employees', 'rosters', 'department'));
}

public function printIndividual(Request $request)
{
    $employee = Employee::findOrFail($request->input('employee_id'));
    $rosters = Roster::where('employee_id', $employee->id)->get();

    return view('rosters.print_individual', compact('employee', 'rosters'));
}


}
