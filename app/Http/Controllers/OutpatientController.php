<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outpatient;
use App\Models\Patient;
use App\Models\Doctor;

class OutpatientController extends Controller
{
    // List all outpatients with pagination
    public function index()
    {
        $outpatients = Outpatient::with(['patient', 'doctor'])
                        ->orderBy('visit_date', 'desc')
                        ->paginate(15);

        return view('outpatients.index', compact('outpatients'));
    }

    // Show form for new outpatient registration
  public function create()
{
    $patients = Patient::orderBy('last_name')->get();
    $doctors = Doctor::orderBy('name')->get();
$visits = \App\Models\Visit::with('patient')
    ->where('type', 'OPD')
    ->get();

    return view('outpatients.create', compact('patients', 'doctors','visits'));
}

    // Approve outpatient visit (example action)
    public function approve($id)
    {
        $outpatient = Outpatient::findOrFail($id);
        $outpatient->status = 'pending';
        $outpatient->save();

        return redirect()->route('outpatients.index')->with('success', 'Outpatient visit approved.');
    }

    // Show outpatient details
    public function show($id)
    {
        $outpatient = Outpatient::with(['patient', 'doctor'])->findOrFail($id);
        return view('outpatients.show', compact('outpatient'));
    }

    // Show edit form
   public function edit($id)
{
    $outpatient = Outpatient::findOrFail($id);
    $patients = Patient::orderBy('last_name')->get();
    $doctors = Doctor::orderBy('name')->get();

    return view('outpatients.edit', compact('outpatient', 'patients', 'doctors'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'visit_id'    => 'required|exists:visits,id',
        'patient_id'  => 'nullable|exists:patients,id',
        'doctor_id'   => 'nullable|exists:doctors,id',
        'visit_date'  => 'required|date',
        'status'      => 'required|in:pending,completed',
    ]);

    // Check if the visit already has status 'pending' in Outpatient
    $alreadyPending = Outpatient::where('visit_id', $validated['visit_id'])
        ->where('status', 'pending')
        ->exists();

    if ($alreadyPending) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This visit already has a pending outpatient entry.');
    }

    Outpatient::create($validated);

    return redirect()->route('outpatients.index')
        ->with('success', 'Outpatient registered successfully.');
}


public function update(Request $request, $id)
{
    $outpatient = Outpatient::findOrFail($id);

    $validated = $request->validate([
        'patient_id'  => 'required|exists:patients,id',
        'doctor_id'   => 'nullable|exists:doctors,id',
        'visit_date'  => 'required|date',
        'status'      => 'required|in:pending,completed',
    ]);

    $outpatient->update($validated);

    return redirect()->route('outpatients.index')
        ->with('success', 'Outpatient record updated successfully.');
}

}
