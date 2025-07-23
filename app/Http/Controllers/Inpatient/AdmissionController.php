<?php
namespace App\Http\Controllers\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\TransferHistory;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Bed;
use App\Models\Billing\InvoiceItem;
use App\Models\Billing\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    public function index()
    {
        $admissions = Admission::with('patient', 'visit')->latest()->paginate(20);
        return view('inpatient.admissions.index', compact('admissions'));
    }

    public function create()
    {
        $patients = Patient::all();
        // Only get IPD visits with their patient
$visits = \App\Models\Visit::with('patient')
    ->where('type', 'IP')
    ->get();
        return view('inpatient.admissions.create', compact('patients', 'visits'));
    }

  public function store(Request $request)
{
    $request->validate([
        'visit_id' => 'required|exists:visits,id',
        'notes' => 'nullable|string',
    ]);

// Check if there's already an admission with status 'admitted' or 'pending' for this visit
$alreadyAdmitted = Admission::where('visit_id', $request->visit_id)
    ->whereIn('status', ['admitted', 'pending'])
    ->exists();

if ($alreadyAdmitted) {
    return redirect()->back()->with('error', 'This visit already has an active admission.');
}

    Admission::create([
        'visit_id' => $request->visit_id,
        'requested_by' => auth()->id(),
        'status' => 'pending',
        'notes' => $request->notes,
       
    ]);

    return redirect()->route('admissions.index')->with('success', 'Admission request created.');
}


    
public function approve($id)
{
    $admission = Admission::findOrFail($id);
    $admission->approve(auth()->id());
    return redirect()->back()->with('success', 'Admission approved.');
}

public function showAssignBed($id)
{
    $admission = Admission::findOrFail($id);
    $beds = \App\Models\Bed::all();
$wards = \App\Models\Ward::all();

    return view('inpatient.admissions.assign_bed', compact('admission', 'beds','wards'));
}



public function assignBed(Request $request, $id)
{
    $request->validate([
        'bed_id' => 'required|exists:beds,id',
        'ward_id' => 'required|exists:wards,id',
    ]);

    $admission = Admission::findOrFail($id);

    if ($admission->bed_id) {
        return redirect()->route('admissions.index')->with('error', 'A bed is already assigned.');
    }

    DB::beginTransaction();

    try {
        // Assign bed and ward
        $admission->bed_id = $request->bed_id;
        $admission->ward_id = $request->ward_id;
        $admission->save();

        // Mark the bed as occupied
        $bed = Bed::findOrFail($request->bed_id);
        $bed->status = 'occupied';

        if (!$bed->save()) {
            DB::rollBack();
            return back()->with('error', 'Failed to update bed status.');
        }

        // Retrieve or create invoice
        $visitId = $admission->visit_id;
        $invoice = Invoice::firstOrCreate(
            ['visit_id' => $visitId],
            ['amount' => 0, 'amount_paid' => 0, 'balance_due' => 0]
        );

        // Add invoice item for bed
        $bedCharge = $bed->charge ?? 0;

        InvoiceItem::create([
            'invoice_id' => $invoice->id,
            'description' => 'Bed Assignment - ' . $bed->name,
            'quantity' => 1,
            'unit_price' => $bedCharge,
            'total' => $bedCharge,
            'category' => 'bed',
        ]);

        // Update invoice totals
        $totalAmount = $invoice->items()->sum('total');
        $invoice->amount = $totalAmount;
        $invoice->balance_due = $totalAmount - $invoice->amount_paid;
        $invoice->save();

        DB::commit();

        return redirect()->route('admissions.index')->with('success', 'Bed and ward assigned and billed.');
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Bed assignment error: ' . $e->getMessage());
        return back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}



public function showTransfer($id)
{
    $admission = Admission::findOrFail($id);
    $wards = \App\Models\Ward::all();
    return view('inpatient.admissions.transfer', compact('admission', 'wards'));
}




public function transfer(Request $request, $id)
{
    $request->validate([
        'ward_id' => 'required|exists:wards,id',
        'bed_id' => 'required|exists:beds,id',
    ]);

    $admission = Admission::findOrFail($id);

    // Mark old bed as available
    if ($admission->bed_id) {
        $oldBed = \App\Models\Bed::find($admission->bed_id);
        if ($oldBed) {
            $oldBed->status = 'available';
            $oldBed->save();
        }
    }

    // Log transfer history
    TransferHistory::create([
        'admission_id' => $admission->id,
        'from_ward_id' => $admission->ward_id,
        'to_ward_id' => $request->ward_id,
        'from_bed_id' => $admission->bed_id,
        'to_bed_id' => $request->bed_id,
        'transferred_by' => auth()->id(),
        'transferred_at' => now(),
        'notes' => $request->notes ?? null,
    ]);

    // Assign new bed and ward
    $admission->ward_id = $request->ward_id;
    $admission->bed_id = $request->bed_id;
    $admission->save();

    // Mark new bed as occupied
    $newBed = \App\Models\Bed::findOrFail($request->bed_id);
    $newBed->status = 'occupied';
    $newBed->save();

    return redirect()->route('admissions.index')->with('success', 'Patient transferred successfully.');
}


public function show($id)
{
    $admission = \App\Models\Admission::with(['patient', 'ward', 'bed', 'transferHistories.fromWard', 'transferHistories.toWard', 'transferHistories.fromBed', 'transferHistories.toBed', 'transferHistories.user'])->findOrFail($id);
    return view('inpatient.admissions.show', compact('admission'));
}
}