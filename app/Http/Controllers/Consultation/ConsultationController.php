<?php

namespace App\Http\Controllers\Consultation;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Icd11;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\LabTest;
use App\Models\RadiologyService;
use App\Models\Visit;
use App\Models\Drug;
use App\Models\User;
use App\Models\Service;
use App\Models\RouteModel;
use App\Models\Dosage;
use App\Models\Procedure;


use Spatie\Permission\Models\Role;





class ConsultationController extends Controller
{
 
public function index()
{
    // Only show consultations for OPD visits
    $consultations = \App\Models\Consultation::whereHas('visit', function($query) {
        $query->where('type', 'OPD');
    })->with('visit.patient')->latest()->paginate(10);
    return view('visits.consultation.index', compact('consultations'));
}

public function create(Request $request)
{
    $visitId = $request->query('visit_id');
    $visit = Visit::find($visitId);

    $icd11s   = ICD11::all();
    $drugs    = Drug::all();        // 💊 Needed for medication tab
    $dosages  = Dosage::all();      // 📏 Dosage options
    $routes   = RouteModel::all();       // 🚚 Route of administration
    $labs     = LabTest::all();  // 🧪 Lab services
    $radiology = RadiologyService::all(); // 🖼️ Imaging
    $services = Service::all();     // 💼 General services
    $procedures = Procedure::all(); // 🛠️ Procedures
$systematics = \App\Models\SystematicExamination::all();
$diagnoses = \App\Models\ClinicalDiagnosis::all(); // or use ICD model


    return view('outpatients.consultation.create', compact(
        'visit', 'icd11s', 'drugs', 'dosages', 'routes',
        'labs', 'radiology', 'services', 'procedures','systematics', 'diagnoses'
    ));
}




public function store(Request $request)
{
    $request->validate([
        'visit_id'              => 'required|exists:visits,id',
        'notes'                 => 'required|string',
        'past_history'          => 'nullable|string',
        'general_examination'   => 'nullable|string',
        'systematic_examination'=> 'nullable|string',
        'investigation'         => 'nullable|string',
        'diagnosis'             => 'nullable|string',
        'icd11_diagnosis'       => 'nullable|string',
        'treatment_plan'        => 'nullable|string',
    ]);

    Consultation::create([
        'visit_id'              => $request->visit_id,
        'notes'                 => $request->notes,
        'past_history'          => $request->past_history,
        'general_examination'   => $request->general_examination,
        'systematic_examination'=> $request->systematic_examination,
        'investigation'         => $request->investigation,
        'diagnosis'             => $request->diagnosis,
        'icd11_diagnosis'       => $request->icd11_diagnosis,
        'treatment_plan'        => $request->treatment_plan,
    ]);

    return redirect()->route('visits.index')->with('success', 'Consultation notes saved successfully.');
}


public function createNote()
{
    $visits = \App\Models\Visit::with('patient')->get();
    return view('visits.consultation.note.create', compact('visits'));
}
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
        'user_id' => auth()->id(), // optional: track who added the note
    ]);

    return redirect()->back()->with('success', 'Note added successfully.');
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