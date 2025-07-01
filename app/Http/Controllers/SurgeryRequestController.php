<?php

namespace App\Http\Controllers;

use App\Models\Surgery;
use Illuminate\Http\Request;

class SurgeryRequestController extends Controller
{
    /**
     * Display a listing of surgery requests.
     */
    public function index()
    {
        $requests = Surgery::where('status', 'requested')->get();
        return view('operation_theatre.requests', compact('requests'));
    }

    /**
     * Show the form for creating a new surgery request.
     */
    public function create()
    {
        return view('operation_theatre.create_request');
    }

    /**
     * Store a newly created surgery request in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'surgery_type' => 'required|string|max:255',
        ]);

        Surgery::create([
            'patient_name' => $request->patient_name,
            'surgery_type' => $request->surgery_type,
            'status' => 'requested',
        ]);

        return redirect()->route('surgery.requests')->with('success', 'Surgery request created successfully.');
    }

    /**
     * Show the details of a specific surgery request.
     */
    public function show($id)
    {
        $surgery = Surgery::findOrFail($id);
        return view('operation_theatre.show_request', compact('surgery'));
    }

    /**
     * Remove the specified surgery request.
     */
    public function destroy($id)
    {
        $surgery = Surgery::findOrFail($id);

        // Optional: only allow deletion if it's still in 'requested' state
        if ($surgery->status !== 'requested') {
            return redirect()->back()->with('error', 'Only requested surgeries can be deleted.');
        }

        $surgery->delete();
        return redirect()->route('surgery.requests')->with('success', 'Surgery request deleted.');
    }
}
