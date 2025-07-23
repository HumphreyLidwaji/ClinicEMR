<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Consultation,
    ConsultationNote,
    ConsultationHistory,
    ConsultationSystematic,
    ConsultationDiagnosis,
    ConsultationICD11,
    Diagnosis,
    SystematicExamination,
    ICD11Code
};
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    // Store a consultation note (progress, consult, procedure, nursing, history_physical)
    public function storeNote(Request $request)
    {
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'note_type' => 'required|in:progress,history_physical,consult,procedure,nursing',
            'body' => 'required|string',
        ]);

        ConsultationNote::updateOrCreate(
            [
                'consultation_id' => $validated['consultation_id'],
                'note_type' => $validated['note_type'],
            ],
            [
                'body' => $validated['body'],
                'created_by' => Auth::id(),
            ]
        );

        return back()->with('success', 'Note saved successfully.');
    }

    // Store history & physical details: past_history, general_examination, investigation
    public function storeHistory(Request $request)
    {
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'past_history' => 'nullable|string',
            'general_examination' => 'nullable|string',
            'investigation' => 'nullable|string',
        ]);

        ConsultationHistory::updateOrCreate(
            ['consultation_id' => $validated['consultation_id']],
            [
                'past_history' => $validated['past_history'],
                'general_examination' => $validated['general_examination'],
                'investigation' => $validated['investigation'],
                'created_by' => Auth::id(),
            ]
        );

        return back()->with('success', 'History & physical saved successfully.');
    }

    // Store systematic examination record
    public function storeSystematic(Request $request)
    {
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'systematic_examination_id' => 'required|exists:systematic_examinations,id',
        ]);

        ConsultationSystematic::updateOrCreate(
            [
                'consultation_id' => $validated['consultation_id'],
                'systematic_examination_id' => $validated['systematic_examination_id'],
            ],
            ['created_by' => Auth::id()]
        );

        return back()->with('success', 'Systematic examination saved successfully.');
    }

    // Store diagnosis
    public function storeDiagnosis(Request $request)
    {
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'diagnosis_id' => 'required|exists:diagnoses,id',
        ]);

        ConsultationDiagnosis::updateOrCreate(
            [
                'consultation_id' => $validated['consultation_id'],
                'diagnosis_id' => $validated['diagnosis_id'],
            ],
            ['created_by' => Auth::id()]
        );

        return back()->with('success', 'Diagnosis saved successfully.');
    }

    // Store ICD11 diagnosis
    public function storeICD11(Request $request)
    {
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'icd11_code_id' => 'required|exists:icd11_codes,id',
        ]);

        ConsultationICD11::updateOrCreate(
            [
                'consultation_id' => $validated['consultation_id'],
                'icd11_code_id' => $validated['icd11_code_id'],
            ],
            ['created_by' => Auth::id()]
        );

        return back()->with('success', 'ICD11 diagnosis saved successfully.');
    }

    // Store treatment plan
    public function storePlan(Request $request)
    {
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'treatment_plan' => 'required|string',
        ]);

        $consultation = Consultation::findOrFail($validated['consultation_id']);
        $consultation->treatment_plan = $validated['treatment_plan'];
        $consultation->updated_by = Auth::id();
        $consultation->save();

        return back()->with('success', 'Treatment plan saved successfully.');
    }
}
