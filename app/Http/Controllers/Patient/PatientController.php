<?php

namespace App\Http\Controllers\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\County;
use Illuminate\Support\Facades\DB;
class PatientController extends Controller
{
   public function index()
{
    $patients = \App\Models\Patient::with(['county', 'subcounty', 'ward'])->paginate(15);

    return view('patients.index', compact('patients'));
}


    public function create()
    {
          $counties = County::all();
    return view('patients.create', compact('counties'));
        
    }




public function store(Request $request)
{
    $request->validate([
        'first_name'            => 'required|string|max:255',
        'last_name'             => 'required|string|max:255',
        'dob'                   => 'required|date',
        'id_number'             => 'nullable|string|max:100',
        'gender'                => 'required|string',
        'phone'                 => 'nullable|string|max:20',
        'email'                 => 'nullable|email|max:255',
        'guardian_name'         => 'nullable|string|max:255',
        'guardian_relationship' => 'nullable|string|max:100',
        'guardian_phone'        => 'nullable|string|max:20',
        'guardian_email'        => 'nullable|email|max:255',
        'county_id'             => 'required|exists:counties,id',
        'subcounty_id'          => 'required|exists:subcounties,id',
        'ward_id'               => 'required|exists:sub_county_wards,id',
    ]);

    // Check if patient exists by id_number or phone
    $existing = \App\Models\Patient::where(function ($q) use ($request) {
        if ($request->id_number) {
            $q->where('id_number', $request->id_number);
        }
        if ($request->phone) {
            $q->orWhere('phone', $request->phone);
        }
    })->first();

    if ($existing) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'A patient with this ID number or phone already exists.');
    }

    // Get hospital initials from .env
    $hospitalInitials = env('HOSPITAL_CODE', 'CLINIC'); // fallback if not set

    // Determine current year
    $year = now()->format('Y');

    // Count existing patients for the year
    $latest = \App\Models\Patient::whereYear('created_at', $year)->count();
    $sequence = str_pad($latest + 1, 4, '0', STR_PAD_LEFT); // e.g., 0001, 0023

    // Construct patient number
    $patient_no = "{$hospitalInitials}/{$year}/{$sequence}";

    // Add patient_no to data and create
    $data = $request->all();
    $data['patient_no'] = $patient_no;

    \App\Models\Patient::create($data);

    return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
}



   public function edit(Patient $patient)
{
    // Load all counties for the county dropdown
    $counties = \App\Models\County::all();

    // Load subcounties filtered by the patient's county_id
    $subcounties = $patient->county_id
        ? \App\Models\Subcounty::where('county_id', $patient->county_id)->get()
        : collect();

    // Load wards filtered by the patient's subcounty_id
 $wards = $patient->subcounty_id
    ? \App\Models\SubCountyWard::where('subcounty_id', $patient->subcounty_id)->get()
    : collect();
  

    return view('patients.edit', compact('patient', 'counties', 'subcounties', 'wards'));
}


public function update(Request $request, Patient $patient)
{
    $request->validate([
        'first_name'            => 'required|string|max:255',
        'last_name'             => 'required|string|max:255',
        'dob'                   => 'required|date',
        'id_number'             => 'nullable|string|max:100',
        'gender'                => 'required|string',
        'phone'                 => 'nullable|string|max:20',
        'email'                 => 'nullable|email|max:255',
        'guardian_name'         => 'nullable|string|max:255',
        'guardian_relationship' => 'nullable|string|max:100',
        'guardian_phone'        => 'nullable|string|max:20',
        'guardian_email'        => 'nullable|email|max:255',
        'county_id'             => 'required|exists:counties,id',
        'subcounty_id'          => 'required|exists:subcounties,id',
        'ward_id'               => 'required|exists:sub_county_wards,id',
    ]);

    $patient->update($request->all());

    return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
}


    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }

    public function summary($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.summary', compact('patient'));
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }
}