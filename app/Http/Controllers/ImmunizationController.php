<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\ImmunizationSchedule;
use App\Models\ImmunizationRecord;
use Illuminate\Http\Request;
use PDF;

class ImmunizationController extends Controller
{
    /**
     * Show immunization schedule + records for a patient
     */
    public function index($patient_id)
    {
        $patient = Patient::with('immunizationRecords.schedule')->findOrFail($patient_id);
        $schedules = ImmunizationSchedule::all();

        // Auto-create missing records
        foreach ($schedules as $schedule) {
            ImmunizationRecord::firstOrCreate([
                'patient_id' => $patient->id,
                'immunization_schedule_id' => $schedule->id
            ]);
        }

        // Reload with relationships
        $patient->load([
            'immunizationRecords.schedule',
            'immunizationRecords.maternityCase',
            'immunizationRecords.visit'
        ]);

        return view('immunizations.index', compact('patient', 'schedules'));
    }

    /**
     * Update an immunization record (mark as given)
     */
    public function update(Request $request, $record_id)
    {
        $record = ImmunizationRecord::findOrFail($record_id);

        $validated = $request->validate([
            'given_date' => 'nullable|date',
            'is_given' => 'required|boolean',
            'remarks' => 'nullable|string|max:255',
            'maternity_case_id' => 'nullable|exists:maternity_cases,id',
            'visit_id' => 'nullable|exists:visits,id',
        ]);

        $record->update($validated);

        return back()->with('success', 'Immunization record updated.');
    }

    /**
     * Generate PDF report of immunizations
     */
    public function print($patient_id)
    {
        $patient = Patient::with([
            'immunizationRecords.schedule',
            'immunizationRecords.maternityCase',
            'immunizationRecords.visit'
        ])->findOrFail($patient_id);

        $pdf = PDF::loadView('immunizations.print', compact('patient'));

        return $pdf->download('Immunization_Report_' . $patient->id . '.pdf');
    }
}
