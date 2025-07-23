<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DischargeSummary;
use App\Models\Visit;
use App\Models\User;

use App\Models\Prescription;     
use App\Models\Icd11;
use Spatie\Permission\Models\Role;
use PDF; 
class DischargeSummaryController extends Controller
{

     /**
     * Optional: List all discharge summaries
     */
 public function index()
{
    $summaries = DischargeSummary::with(['visit.patient', 'doctor', 'icd11'])->latest()->paginate(20);

    return view('inpatient.discharge.index', compact('summaries'));
}

  // At the top

public function exportPdf($id)
{
    $summary = DischargeSummary::with('visit.patient')->findOrFail($id);
    $pdf = PDF::loadView('inpatient.discharge.pdf', compact('summary'));
    return $pdf->download('discharge-summary-' . $summary->id . '.pdf');
}

    /**
     * Store a newly created discharge summary.
     */
    public function store(Request $request)
{
    $request->validate([
        'visit_id' => 'required|exists:visits,id',
        'discharge_date' => 'required|date',
        'summary' => 'required|string',
        'outcome' => 'required|in:recovered,referred,death',
        'referral_note' => 'nullable|string',
        'death_note' => 'nullable|string',
        'attending_doctor_id' => 'required|exists:users,id',
        'icd11_id' => 'required|exists:icd11s,id',
    ]);

    // Prevent duplicate discharge for the same visit
    if (DischargeSummary::where('visit_id', $request->visit_id)->exists()) {
        return redirect()->back()->withErrors(['error' => 'This visit already has a discharge summary.']);
    }

    DischargeSummary::create([
        'visit_id' => $request->visit_id,
        'discharge_date' => $request->discharge_date,
        'summary' => $request->summary,
        'outcome' => $request->outcome,
        'referral_note' => $request->referral_note,
        'death_note' => $request->death_note,
        'icd11_id' => $request->icd11_id,
        'attending_doctor_id' => $request->attending_doctor_id,
    ]);

foreach ($request->input('drugs', []) as $i => $drug_id) {
    Prescription::create([
        'visit_id'     => $request->visit_id,
        'drug_id'      => $drug_id,
        'dosage_id'    => $request->dosages[$i],
        'route_id'     => $request->routes[$i],
        'duration'     => $request->durations[$i],
        'quantity'     => $request->quantities[$i],
        'is_discharge_med' => true,
    ]);
}


    // Now mark the visit as closed
    Visit::where('id', $request->visit_id)->update([
        'is_active' => false,
        'end_date' => $request->discharge_date,
    ]);

    return redirect()->back()->with('success', 'Discharge summary saved successfully.');
}

public function edit($id)
{
    $summary = DischargeSummary::with(['visit', 'doctor', 'icd11'])->findOrFail($id);
 $doctors = User::role('doctor')->get();
    $icd11s = Icd11::orderBy('code')->get();

    return view('inpatient.discharge.edit', compact('summary', 'doctors', 'icd11s'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'discharge_date' => 'required|date',
        'summary' => 'required|string',
        'outcome' => 'required|in:recovered,referred,death',
        'referral_note' => 'nullable|string',
        'death_note' => 'nullable|string',
        'attending_doctor_id' => 'required|exists:users,id',
        'icd11_id' => 'required|exists:icd11s,id',
    ]);

    $summary = DischargeSummary::findOrFail($id);

    $summary->update([
        'discharge_date' => $request->discharge_date,
        'summary' => $request->summary,
        'outcome' => $request->outcome,
        'referral_note' => $request->referral_note,
        'death_note' => $request->death_note,
        'icd11_id' => $request->icd11_id,
        'attending_doctor_id' => $request->attending_doctor_id,
    ]);

    return redirect()->route('discharges.edit', $id)->with('success', 'Discharge summary updated.');
}


    /**
     * Optional: Show discharge summary details
     */
    public function show($id)
    {
        $summary = DischargeSummary::with('visit.patient')->findOrFail($id);
        return view('inpatient.discharge.show', compact('summary'));
    }

   
}
