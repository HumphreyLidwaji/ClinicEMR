<?php

namespace App\Http\Controllers\Maternity;

use App\Http\Controllers\Controller;
use App\Models\MaternityCase;
use App\Models\Patient;
use App\Models\Visit;
  use PDF; // If PDF export is enabled
use Illuminate\Http\Request;

class MaternityCaseController extends Controller
{
    public function index()
    {
        $cases = MaternityCase::with('patient')->latest()->paginate(10);
        return view('maternity.cases.index', compact('cases'));
    }

    public function create()
    {
        $patients = Patient::all();
        $visits = Visit::all();
        return view('maternity.cases.create', compact('patients', 'visits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'lmp' => 'required|date',
            'gravida' => 'nullable|integer',
            'parity' => 'nullable|integer',
        ]);

        $edd = date('Y-m-d', strtotime($request->lmp . ' +280 days'));

        MaternityCase::create([
            'patient_id' => $request->patient_id,
            'visit_id' => $request->visit_id,
            'lmp' => $request->lmp,
            'edd' => $edd,
            'gravida' => $request->gravida,
            'parity' => $request->parity,
            'notes' => $request->notes,
        ]);

        return redirect()->route('cases.index')->with('success', 'Maternity case created.');
    }

    public function show(MaternityCase $case)
    {
        return view('maternity.cases.show', compact('case'));
    }

    public function edit(MaternityCase $case)
    {
        $patients = Patient::all();
        $visits = Visit::all();
        return view('maternity.cases.edit', compact('case', 'patients', 'visits'));
    }

    public function update(Request $request, MaternityCase $case)
    {
        $request->validate([
            'patient_id' => 'required',
            'lmp' => 'required|date',
        ]);

        $case->update([
            'patient_id' => $request->patient_id,
            'visit_id' => $request->visit_id,
            'lmp' => $request->lmp,
            'edd' => date('Y-m-d', strtotime($request->lmp . ' +280 days')),
            'gravida' => $request->gravida,
            'parity' => $request->parity,
            'notes' => $request->notes,
        ]);

        return redirect()->route('cases.index')->with('success', 'Maternity case updated.');
    }

    public function destroy(MaternityCase $case)
    {
        $case->delete();
        return back()->with('success', 'Maternity case deleted.');
    }

  

public function print($id)
{
    $case = MaternityCase::with([
        'patient',
        'ancVisits',
        'delivery.babies'
    ])->findOrFail($id);

    if (request()->get('pdf') === '1') {
        $pdf = \PDF::loadView('maternity.cases.print', compact('case'));
        return $pdf->download('MoH510_Maternity_Case_'.$case->id.'.pdf');
    }

    return view('maternity.cases.print', compact('case'));
}

}
