<?php

namespace App\Http\Controllers\Maternity;

use App\Http\Controllers\Controller;
use App\Models\MaternityCase;
use App\Models\Delivery;
use App\Models\Visit;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function create($case_id)
    {
        $case = MaternityCase::findOrFail($case_id);
        $visits = Visit::where('patient_id', $case->patient_id)->get();
        return view('maternity.deliveries.create', compact('case', 'visits'));
    }

    public function store(Request $request, $case_id)
    {
        $request->validate([
            'delivery_date' => 'required|date',
            'delivery_type' => 'required|in:Spontaneous,C-Section,Vacuum,Forceps',
        ]);

        Delivery::create([
            'maternity_case_id' => $case_id,
            'visit_id' => $request->visit_id,
            'delivery_date' => $request->delivery_date,
            'delivery_type' => $request->delivery_type,
            'complications' => $request->complications,
        ]);

        return redirect()->route('cases.show', $case_id)->with('success', 'Delivery recorded.');
    }
}
