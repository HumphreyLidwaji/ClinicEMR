<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientAttachment;
use Illuminate\Http\Request;

class PatientAttachmentController extends Controller
{
    public function create()
    {
        $patients = Patient::all();
        return view('patients.attachments.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'file' => 'required|file|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $path = $request->file('file')->store('attachments', 'public');

        PatientAttachment::create([
            'patient_id' => $request->patient_id,
            'file_path' => $path,
            'description' => $request->description,
        ]);

        return redirect()->route('patients.index')->with('success', 'Attachment uploaded successfully.');
    }
}