<?php

namespace App\Http\Controllers\Medication;

use App\Http\Controllers\Controller;
use App\Models\Prescription; // ✅ Use this instead
use App\Models\Visit;
use App\Models\Drug;
use App\Models\Dosage;
use App\Models\RouteModel;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function create()
    {
        $visits = Visit::with('patient')->get();
        $drugs = Drug::all();
        $dosages = Dosage::all();
        $routes = RouteModel::all();

        return view('visits.medication', compact('visits', 'drugs', 'dosages', 'routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'visit_id'    => 'required|exists:visits,id',
            'drugs'       => 'required|array',
            'drugs.*'     => 'required|exists:drugs,id',
        
            'dosages.*'   => 'required|exists:dosages,id',
            'routes'      => 'required|array',
            'routes.*'    => 'required|exists:routes,id',
            'quantities'  => 'required|array',
            'quantities.*'=> 'required|numeric|min:1',
            'durations'   => 'required|array',
            'durations.*' => 'required|numeric|min:1',
        ]);

        foreach ($request->drugs as $i => $drugId) {
            Prescription::create([
                'visit_id'  => $request->visit_id,
                'drug_id'   => $drugId,
                'dosage_id' => $request->dosages[$i],
                'route_id'  => $request->routes[$i],
                'quantity'  => $request->quantities[$i],
                'duration'  => $request->durations[$i],
            ]);
        }

        return redirect()->back()->with('success', 'Prescriptions saved successfully.');
    }
}
