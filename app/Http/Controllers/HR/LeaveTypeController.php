<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HR\LeaveType;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('hr.leave_types.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('hr.leave_types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        LeaveType::create($data);
        return redirect()->route('leave-types.index')->with('success', 'Leave Type created successfully.');
    }

    public function show(LeaveType $leaveType)
    {
        return view('hr.leave_types.show', compact('leaveType'));
    }

    public function edit(LeaveType $leaveType)
    {
        return view('hr.leave_types.edit', compact('leaveType'));
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $leaveType->update($data);
        return redirect()->route('leave-types.index')->with('success', 'Leave Type updated successfully.');
    }

    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();
        return redirect()->route('leave-types.index')->with('success', 'Leave Type deleted successfully.');
    }
}
