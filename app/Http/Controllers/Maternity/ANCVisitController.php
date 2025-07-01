<?php

namespace App\Http\Controllers\Maternity;

use App\Http\Controllers\Controller;
use App\Models\MaternityCase;
use App\Models\ANCVisit;
use App\Models\Visit;
use Illuminate\Http\Request;

class ANCVisitController extends Controller
{
    public function index($case_id)
    {
        $case = MaternityCase::with('ancVisits')->findOrFail($case_id);
        return view('maternity.anc_visits.index', compact('case'));
    }

    public function create($case_id)
    {
        $case = MaternityCase::findOrFail($case_id);
        $visits = Visit::where('patient_id', $case->patient_id)->get();
        return view('maternity.anc_visits.create', compact('case', 'visits'));
    }

    public function store(Request $request, $case_id)
    {
        $request->validate([
            'visit_date' => 'required|date',
        ]);

        ANCVisit::create([
            'maternity_case_id' => $case_id,
            'visit_id' => $request->visit_id,
            'visit_date' => $request->visit_date,
            'weight' => $request->weight,
            'bp_systolic' => $request->bp_systolic,
            'bp_diastolic' => $request->bp_diastolic,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'notes' => $request->notes,
        ]);

        return redirect()->route('cases.anc-visits.index', $case_id)->with('success', 'ANC Visit recorded.');
    }
}
