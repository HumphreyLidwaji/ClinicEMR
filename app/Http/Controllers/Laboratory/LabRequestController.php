<?php

namespace App\Http\Controllers\Laboratory;

use App\Http\Controllers\Controller;
use App\Models\Laboratory\LabRequest;
use App\Models\Patient\Patient;
use Illuminate\Http\Request;

class LabRequestController extends Controller
{
    public function index()
    {
        $labRequests = LabRequest::with('patient')->get();
        return view('laboratory.lab_requests', compact('labRequests'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('laboratory.create_lab_request', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'test_name' => 'required|string|max:255',
            'date_requested' => 'required|date',
            'status' => 'required|string|max:50',
        ]);
        LabRequest::create($request->all());
        return redirect()->route('lab-requests.index')->with('success', 'Lab request created.');
    }
}