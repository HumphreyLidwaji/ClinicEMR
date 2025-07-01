<?php

namespace App\Http\Controllers\Vital;

use App\Http\Controllers\Controller;
use App\Models\Vital;
use App\Models\Visit;
use Illuminate\Http\Request;

class VitalController extends Controller
{
    public function create()
    {
        $visits = Visit::with('patient')->get();
        return view('visits.vitals', compact('visits'));
    }

  
public function store(Request $request)
{
    $request->validate([
        'visit_id'        => 'required|exists:visits,id',
        'blood_pressure'  => 'nullable|string',
        'pulse'           => 'nullable|integer',
        'temperature'     => 'nullable|numeric',
        'weight'          => 'nullable|numeric',
        'resp'            => 'nullable|integer',
        'spo2'            => 'nullable|integer',
        'rbs'             => 'nullable|numeric',
        'fbs'             => 'nullable|numeric',
    ]);

    Vital::create($request->all());

    return redirect()->back()->with('success', 'Vitals saved successfully.');
}
}