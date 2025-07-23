<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Vital;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\LabOrder;
use App\Models\RadiologyOrder;
use App\Models\ServiceOrder;
use App\Models\ProcedureOrder;
use App\Models\Billing\Invoice;

class EMRController extends Controller
{
    public function index($patientId)
    {
        $patient = Patient::with('visits')->findOrFail($patientId);
        return view('emr.index', compact('patient'));
    }

public function showVisit($visitId)
{
    $visit = Visit::with([
        'patient',
        'vitals',
        'prescriptions.drug',
        'labOrders.labTest',
        'radiologyOrders.radiologyService',
        'serviceOrders.service',
        'procedureOrders.procedure',
        'invoice.items',
    ])->findOrFail($visitId);

    // Load consultation-related data with relationships
    $visitNotes = \App\Models\VisitNote::where('visit_id', $visitId)->get();

    $consultationHistory = \App\Models\ConsultationHistory::where('visit_id', $visitId)->first();

    $consultationSystematicExaminations = \App\Models\ConsultationSystematicExamination::with('systematicExamination')
        ->where('visit_id', $visitId)->get();

    $consultationDiagnoses = \App\Models\ConsultationDiagnosis::with('diagnosis')
        ->where('visit_id', $visitId)->get();

    $consultationICD11s = \App\Models\ConsultationICD11::with('icd11')
        ->where('visit_id', $visitId)->get();

    $treatmentPlan = \App\Models\Consultation::where('visit_id', $visitId)->value('treatment_plan');

    return view('emr.visit-details', compact(
        'visit',
        'visitNotes',
        'consultationHistory',
        'consultationSystematicExaminations',
        'consultationDiagnoses',
        'consultationICD11s',
        'treatmentPlan'
    ));
}



public function printVisit($visitId)
{
    $visit = Visit::with([
        'patient',
        'vitals',
        'consultation',
        'prescriptions.drug',
        'labOrders.labTest',
        'radiologyOrders.radiologyService',
        'serviceOrders.service',
        'procedureOrders.procedure',
        'invoice.items',
    ])->findOrFail($visitId);

    $visitNotes = \App\Models\VisitNote::where('visit_id', $visitId)->get();
    $consultationHistory = \App\Models\ConsultationHistory::where('visit_id', $visitId)->first();
    $consultationDiagnoses = \App\Models\ConsultationDiagnosis::with('diagnosis')->where('visit_id', $visitId)->get();
    $consultationSystematicExaminations = \App\Models\ConsultationSystematicExamination::with('systematicExamination')->where('visit_id', $visitId)->get();
    $consultationICD11s = \App\Models\ConsultationICD11::with('icd11')->where('visit_id', $visitId)->get();
    $treatmentPlan = \App\Models\Consultation::where('visit_id', $visitId)->value('treatment_plan');

    return view('emr.print', compact(
        'visit',
        'visitNotes',
        'consultationHistory',
        'consultationDiagnoses',
        'consultationSystematicExaminations',
        'consultationICD11s',
        'treatmentPlan'
    ));
}


}
