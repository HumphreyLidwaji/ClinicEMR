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
        'consultation',
        'prescriptions.drug',
        'labOrders.labTest',
        'radiologyOrders.radiologyService',
        'serviceOrders.service',
        'procedureOrders.procedure',
        'invoice.items',
    ])->findOrFail($visitId);

    return view('emr.visit-details', compact('visit'));
}


    public function printVisit($visitId)
    {
        $visit = Visit::with([
            'patient',
            'latestVitals',
            'vitals',
            'consultation',
           'prescriptions.drug',
            'labOrders.labTest',
            'radiologyOrders.radiologyService',
            'serviceOrders.service',
            'procedureOrders.procedure',
            'invoice.items',
        ])->findOrFail($visitId);

        return view('emr.print', compact('visit'));
    }
}
