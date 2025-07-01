<?php
namespace App\Http\Controllers\Maternity;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Baby;
use PDF;
use Illuminate\Http\Request;

class BabyController extends Controller
{
    public function index($delivery_id)
    {
        $delivery = Delivery::with('babies')->findOrFail($delivery_id);
        return view('maternity.babies.index', compact('delivery'));
    }

    public function create($delivery_id)
    {
        $delivery = Delivery::findOrFail($delivery_id);
        return view('maternity.babies.create', compact('delivery'));
    }
public function store(Request $request, $delivery_id)
{
    $request->validate([
        'name'           => 'required|string|max:255',
        'dob'            => 'required|date',
        'gender'         => 'required|in:male,female',
        'birth_weight'   => 'nullable|numeric|min:0|max:10',
        'apgar_score'    => 'nullable|integer|min:0|max:10',
        'status'         => 'nullable|string|max:100',
        'guardian_name'         => 'nullable|string|max:255',
        'guardian_relationship' => 'nullable|string|max:100',
        'guardian_phone'        => 'nullable|string|max:20',
    ]);

    // Step 1: Create Baby (without patient_id yet)
    $baby = \App\Models\Baby::create([
        'delivery_id'   => $delivery_id,
        'birth_weight'  => $request->birth_weight,
        'apgar_score'   => $request->apgar_score,
        'status'        => $request->status,
    ]);

    // Step 2: Generate unique patient number
    $hospitalInitials = env('HOSPITAL_CODE', 'CLINIC');
    $year = now()->format('Y');
    $latest = \App\Models\Patient::whereYear('created_at', $year)->count();
    $sequence = str_pad($latest + 1, 4, '0', STR_PAD_LEFT);
    $patient_no = "{$hospitalInitials}/{$year}/{$sequence}";

    // Step 3: Create linked Patient
    $patient = \App\Models\Patient::create([
        'first_name'            => $request->name,
        'last_name'             => 'Baby', // Default last name, can customize
        'dob'                   => $request->dob,
        'gender'                => $request->gender,
        'guardian_name'         => $request->guardian_name,
        'guardian_relationship' => $request->guardian_relationship,
        'guardian_phone'        => $request->guardian_phone,
        'patient_no'            => $patient_no,
        'is_baby'               => true,
    ]);

    // Step 4: Link patient to baby
    $baby->update(['patient_id' => $patient->id]);

    return redirect()->route('deliveries.babies.index', $delivery_id)
        ->with('success', 'Baby and patient record created successfully.');
}

public function edit($baby_id)
{
    $baby = \App\Models\Baby::findOrFail($baby_id);
    return view('maternity.babies.edit', compact('baby'));
}

public function update(Request $request, $baby_id)
{
    $baby = \App\Models\Baby::findOrFail($baby_id);

    $request->validate([
        'name' => 'required|string|max:255',
        'dob' => 'required|date',
        'gender' => 'required|in:male,female',
        'birth_weight' => 'nullable|numeric|min:0|max:10',
        'apgar_score' => 'nullable|integer|min:0|max:10',
        'status' => 'nullable|string|max:100',
    ]);

    $baby->update($request->only([
        'name', 'dob', 'gender', 'birth_weight', 'apgar_score', 'status'
    ]));

    return redirect()->route('deliveries.babies.index', $baby->delivery_id)
        ->with('success', 'Baby details updated.');
}
    

public function print($baby_id)
{
    $baby = \App\Models\Baby::with('delivery.maternityCase.patient')->findOrFail($baby_id);
    $patient = $baby->patient;

    $pdf = PDF::loadView('maternity.babies.print', compact('baby', 'patient'));

    return $pdf->download('Birth_Certificate_'.$baby->id.'.pdf');
}


}
