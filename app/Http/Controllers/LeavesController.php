<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveBalance;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeavesController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('employee')->latest()->get();
        return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('leaves.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ]);

        Leave::create($request->all());
        return redirect()->route('leaves.index')->with('success', 'Leave applied successfully.');
    }

 public function approve(Leave $leave)
{
    // Calculate leave days
    $days = $leave->start_date->diffInDays($leave->end_date) + 1;
    

    // Update balance
    $balance = LeaveBalance::firstOrCreate([
        'employee_id' => $leave->employee_id,
        'leave_type' => $leave->leave_type,
    ], [
        'entitled_days' => 21, // default
        'used_days' => 0,
    ]);

    if ($balance->remaining_days < $days) {
        return back()->with('error', 'Insufficient leave balance.');
    }

    $balance->used_days += $days;
    $balance->save();

    $leave->update([
        'status' => 'approved',
        'approved_by' => auth()->id(),
        'approved_at' => now(),
    ]);

    return back()->with('success', 'Leave approved and balance updated.');
}


    public function reject(Leave $leave)
    {
        $leave->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);
        return back()->with('success', 'Leave rejected.');
    }

    public function show($id)
{
    $leave = Leave::findOrFail($id);
    return view('leaves.show', compact('leave'));
}

}
