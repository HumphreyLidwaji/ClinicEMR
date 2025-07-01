<?php

namespace App\Http\Controllers;
use App\Models\Roster;
use App\Models\Employee;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    public function index()
    {
        $rosters = Roster::with('employee')->orderBy('shift_date', 'desc')->get();
        return view('rosters.index', compact('rosters'));
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
}
