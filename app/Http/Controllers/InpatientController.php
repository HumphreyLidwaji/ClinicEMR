<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InpatientConsultation;
use App\Models\ProgressNote;
use App\Models\NursingNote;
use Illuminate\Support\Facades\Auth; 
class InpatientController extends Controller
{
    // Store Consultation
    public function storeConsultation(Request $request)
    {
        $validated = $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'consultation_date' => 'required|date',
            'notes' => 'required|string',
            'past_history' => 'nullable|string',
            'general_examination' => 'nullable|string',
            'systematic_examination' => 'nullable|string',
            'investigation' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'icd11_diagnosis' => 'required|string',
            'treatment_plan' => 'nullable|string',
        ]);
        
$validated['created_by'] = Auth::id();
        InpatientConsultation::create($validated);

        return back()->with('success', 'Consultation saved successfully.');
    }

    // Store Daily Progress Note
    public function storeProgress(Request $request)
    {
        $validated = $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'progress_date' => 'required|date',
            'subjective' => 'required|string',
            'objective' => 'nullable|string',
            'assessment' => 'required|string',
            'plan' => 'required|string',
        ]);
        $validated['created_by'] = Auth::id();

        ProgressNote::create($validated);

        return back()->with('success', 'Progress note saved successfully.');
    }

    // Store Nursing Note
    public function storeNursing(Request $request)
    {
        $validated = $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'nursing_date' => 'required|date',
            'shift' => 'required|in:Morning,Evening,Night',
            'observations' => 'nullable|string',
            'vitals' => 'nullable|string',
            'interventions' => 'nullable|string',
        ]);
        $validated['created_by'] = Auth::id();

        NursingNote::create($validated);

        return back()->with('success', 'Nursing note saved successfully.');
    }
}
