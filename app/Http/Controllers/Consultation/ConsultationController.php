<?php

namespace App\Http\Controllers\Consultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\{
    Consultation,
    ConsultationHistory,
    ConsultationSystematic,
    ConsultationDiagnosis,
    ConsultationICD11,
    Visit,
    SystematicExamination,
    ClinicalDiagnosis,
    Icd11,
    Drug,
    Dosage,
    RouteModel,
    LabTest,
    RadiologyService,
    Service,
    Procedure,
    User,
    Admission
};


use Spatie\Permission\Models\Role;





class ConsultationController extends Controller
{
public function index()
    {
        $consultations = Consultation::whereHas('visit', fn($q) => $q->where('type', 'OPD'))
            ->with('visit.patient')
            ->latest()
            ->paginate(10);

        return view('visits.consultation.index', compact('consultations'));
    }

    public function create(Request $request)
    {
        $visit = Visit::findOrFail($request->query('visit_id'));

        $icd11s = ICD11::all();
        $drugs = Drug::all();
        $dosages = Dosage::all();
        $routes = RouteModel::all();
        $labs = LabTest::all();
        $radiology = RadiologyService::all();
        $services = Service::all();
        $procedures = Procedure::all();
        $systematics = SystematicExamination::all();
        $diagnoses = ClinicalDiagnosis::all();

        return view('outpatients.consultation.create', compact(
            'visit', 'icd11s', 'drugs', 'dosages', 'routes',
            'labs', 'radiology', 'services', 'procedures', 'systematics', 'diagnoses'
        ));
    }

    // Save clinical history (past history, general exam, investigation)
public function storeHistory(Request $request)
{
    
    $request->validate([
        'visit_id' => 'required|exists:visits,id',
        'past_history' => 'nullable|string',
        'general_examination' => 'nullable|string',
        'investigation' => 'nullable|string',
    ]);

    // Assuming you have a model ConsultationHistory
    \App\Models\ConsultationHistory::create([
         'visit_id' => $request->visit_id,
        'past_history' => $request->past_history,
        'general_examination' => $request->general_examination,
        'investigation' => $request->investigation,
        'user_id' => auth()->id(), // Track who added it
    ]);

    return redirect()->back()->with('success', 'History and Physical saved successfully.');
}

    // Add or update systematic examination (multiple allowed)
public function storeSystematic(Request $request)
{
    $request->validate([
      'visit_id' => 'required|exists:visits,id',
        'systematic_examination_id' => 'required|exists:systematic_examinations,id',
    ]);

    \App\Models\ConsultationSystematicExamination::create([
        'visit_id' => $request->visit_id,
        'systematic_examination_id' => $request->systematic_examination_id,
        'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Systematic Examination saved successfully.');
}

    //savenote
public function storeNote(Request $request)
{
    $request->validate([
        'visit_id' => 'required|exists:visits,id',
        'note_type' => 'required|string|max:50',
        'note' => 'required|string',
    ]);

    \App\Models\VisitNote::create([
        'visit_id' => $request->visit_id,
        'note_type' => $request->note_type,
        'note' => $request->note,
        'user_id' => auth()->id(), // track who added the note
    ]);

    return redirect()->back()->with('success', 'Note added successfully.');
}

    // Add diagnosis (multiple allowed)
public function storeDiagnosis(Request $request)
{
    $request->validate([
        'visit_id' => 'required|exists:visits,id',
        'diagnosis_id' => 'required|exists:clinical_diagnoses,id',
        'note' => 'nullable|string',
    ]);

    \App\Models\ConsultationDiagnosis::create([
        'visit_id' => $request->visit_id,
        'diagnosis_id' => $request->diagnosis_id,
        'note' => $request->note,
        'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Diagnosis saved successfully.');
}



    // Add ICD11 diagnosis (multiple allowed)
public function storeICD11(Request $request)
{
    $request->validate([
       'visit_id' => 'required|exists:visits,id',
        'icd11_code_id' => 'required|exists:icd11s,id',
    ]);

    \App\Models\ConsultationICD11::create([
           'visit_id' => $request->visit_id,
        'icd11_code_id' => $request->icd11_code_id,
        'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'ICD11 Diagnosis saved successfully.');
}
//store treatment plan

public function storePlan(Request $request)
{
    $request->validate([
        'visit_id' => 'required|exists:visits,id',
        'treatment_plan' => 'required|string',
    ]);

    // Find the consultation linked to the visit
    $consultation = \App\Models\Consultation::where('visit_id', $request->visit_id)->firstOrFail();

    $consultation->treatment_plan = $request->treatment_plan;
    $consultation->user_id = auth()->id(); // track who updated
    $consultation->save();

    return redirect()->back()->with('success', 'Treatment plan saved successfully.');
}





public function createForAdmission($admission_id)
{
    $admission = Admission::with('patient', 'visit')->findOrFail($admission_id);
 // This will fetch all users who have the 'doctor' role
$doctors = User::role('doctor')->get();
    $visits = Visit::where('id', $admission->visit_id)->get();
    $icd11s = Icd11::all(); // Or however you're loading ICD11 options
    $drugs = Drug::all();
    $dosages = Dosage::all();
     $routes = RouteModel::all(); 
       $labs = LabTest::all();
        $radiology = RadiologyService::all();
        $services = Service::all(); 
         $procedures = Procedure::all();
         $systematics = \App\Models\SystematicExamination::orderBy('system')->get();
$diagnoses = \App\Models\ClinicalDiagnosis::orderBy('name')->get();
$icd11s = \App\Models\ICD11::limit(100)->get(); // or however you're loading ICD11



        
  return view('inpatient.consultation', compact('admission','systematics', 'diagnoses', 'visits', 'icd11s','drugs','dosages', 'routes','labs','radiology','services','procedures','doctors'));

}

}