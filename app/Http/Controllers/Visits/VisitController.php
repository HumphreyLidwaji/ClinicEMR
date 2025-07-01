<?php

namespace App\Http\Controllers\Visits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Billing\Invoice;
use App\Models\AuditLog;


class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with(['patient', 'doctor','department'])->latest()->paginate(10);
        return view('visits.index', compact('visits'));
    }

    public function show($id)
    {
        $visit = Visit::with(['patient', 'doctor'])->findOrFail($id);
        return view('visits.show', compact('visit'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $departments= Department::all();
        return view('visits.create', compact('patients', 'doctors','departments'));
    }

public function store(Request $request)
{
    $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'doctor_id'  => 'required|exists:doctors,id',
        'department_id'  => 'required|exists:departments,id',
        'type'       => 'required|string|max:100',
        'start_date' => 'required|date',
        'is_active'  => 'required|boolean',
    ]);



// Check for active visit for this patient
$activeVisit = Visit::where('patient_id', $request->patient_id)
    ->where('is_active', true)
    ->first();

if ($activeVisit) {
    return redirect()->back()->withInput()->with('error', 'This patient already has an active visit.');
}

// Generate sequential visit number
$lastVisit = Visit::orderBy('id', 'desc')->first();
$nextNumber = $lastVisit ? $lastVisit->id + 1 : 1;
$visitNumber = 'VIS-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

// Create the visit
$visit = Visit::create([
    'patient_id'    => $request->patient_id,
    'doctor_id'     => $request->doctor_id,
    'department_id' => $request->department_id,
    'type'          => $request->type,
    'start_date'    => $request->start_date,
    'is_active'     => $request->is_active,
    'visit_number'  => $visitNumber,
]);

// Log the visit creation
AuditLog::create([
    'user_id'        => auth()->id(),
    'action'         => 'Created a Visit',
    'auditable_type' => Visit::class,
    'auditable_id'   => $visit->id,
    'old_values'     => null,
    'new_values'     => json_encode([
        'visit_number'   => $visitNumber,
        'patient_id'     => $request->patient_id,
        'doctor_id'      => $request->doctor_id,
        'department_id'  => $request->department_id,
        'type'           => $request->type,
        'start_date'     => $request->start_date,
        'is_active'      => $request->is_active,
    ]),
    'ip_address' => request()->ip(),
]);

   

// Check for active invoice for this visit
$hasInvoice = Invoice::where('visit_id', $visit->id)
    ->where('status', '!=', 'Paid')
    ->exists();

if (!$hasInvoice) {
    // Generate next invoice number
    $lastInvoice = Invoice::orderBy('id', 'desc')->first();
    $nextNumber = $lastInvoice ? $lastInvoice->id + 1 : 1;
    $invoiceNumber = 'INV-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

    // Create invoice
    $invoice = Invoice::create([
        'invoice_number' => $invoiceNumber,
        'visit_id'       => $visit->id,
        'patient_name'   => $visit->patient->first_name . ' ' . $visit->patient->last_name,
        'visit_type'     => $visit->type,
        'amount'         => 0,
        'status'         => 'Unpaid',
    ]);

    // Log the invoice creation
    AuditLog::create([
        'user_id'        => auth()->id(),
        'action'         => 'Created an Invoice for Visit',
        'auditable_type' => Invoice::class,
        'auditable_id'   => $invoice->id,
        'old_values'     => null,
        'new_values'     => json_encode([
            'invoice_number' => $invoiceNumber,
            'amount' => 0,
        ]),
        'ip_address'     => request()->ip(),
    ]);
}


    return redirect()->route('visits.index')->with('success', 'Visit created successfully.');
}

    public function edit($id)
    {
        $visit = Visit::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
          $departments= Department::all();
        return view('visits.edit', compact('visit', 'patients', 'doctors','departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id'  => 'required|exists:doctors,id',
             'department_id'  => 'required|exists:departments,id',
            'type'       => 'required|string|max:100',
            'start_date' => 'required|date',
            'is_active'  => 'required|boolean',
        ]);

        $visit = Visit::findOrFail($id);
        $visit->update($request->all());

        return redirect()->route('visits.index')->with('success', 'Visit updated successfully.');
    }

    public function destroy($id)
    {
        $visit = Visit::findOrFail($id);
        $visit->delete();

        return redirect()->route('visits.index')->with('success', 'Visit deleted successfully.');
    }
}