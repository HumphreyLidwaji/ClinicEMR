<?php
namespace App\Http\Controllers\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\TransferHistory;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

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
            'patient_id' => 'required|exists:patients,id',
            'visit_id' => 'required|exists:visits,id',
            'notes' => 'nullable|string',
        ]);

        Admission::create([
            'patient_id' => $request->patient_id,
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

    // Check if a bed is already assigned
    if ($admission->bed_id) {
        return redirect()->route('admissions.index')->with('error', 'A bed is already assigned to this admission.');
    }

    $admission->bed_id = $request->bed_id;
    $admission->ward_id = $request->ward_id;
    $admission->save();

    // Mark the bed as occupied
    $bed = \App\Models\Bed::findOrFail($request->bed_id);
    $bed->status = 'occupied';
    $bed->save();

    return redirect()->route('admissions.index')->with('success', 'Bed and ward assigned.');
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