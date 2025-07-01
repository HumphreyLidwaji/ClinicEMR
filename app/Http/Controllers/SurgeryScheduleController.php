<?php

namespace App\Http\Controllers;

use App\Models\Surgery;
use Illuminate\Http\Request;

class SurgeryScheduleController extends Controller
{
    /**
     * Display a list of surgeries that need to be scheduled.
     */
    public function index()
    {
        $surgeries = Surgery::where('status', 'requested')->get();
        return view('operation_theatre.schedule', compact('surgeries'));
    }

    /**
     * Show the form to schedule a surgery.
     */
    public function edit($id)
    {
        $surgery = Surgery::findOrFail($id);
        return view('operation_theatre.edit_schedule', compact('surgery'));
    }

    /**
     * Store the scheduled date for a surgery.
     */
    public function schedule(Request $request, $id)
    {
        $request->validate([
            'scheduled_date' => 'required|date|after_or_equal:today',
        ]);

        $surgery = Surgery::findOrFail($id);
        $surgery->update([
            'scheduled_date' => $request->scheduled_date,
            'status' => 'scheduled',
        ]);

        return redirect()->route('surgery.schedule')->with('success', 'Surgery scheduled successfully.');
    }
}
