<?php
// filepath: app/Http/Controllers/RadiologyOrderController.php

namespace App\Http\Controllers;

use App\Models\RadiologyOrder;
use App\Models\Visit;
use App\Models\RadiologyService;
use Illuminate\Http\Request;

class RadiologyOrderController extends Controller
{

        public function index()
    {
        
        $orders = RadiologyOrder::with(['visit', 'imagingTest'])->get();
        return view('radiology.orders.index', compact('orders'));
    }

      public function create()
    {
        $visits = Visit::all();
        $imagings = RadiologyService::all();
        return view('radiology.orders.create', compact('visits', 'imagings'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:radiology_services,id',
        ]);

        foreach ($request->services as $serviceId) {
            $service = RadiologyService::find($serviceId);
            RadiologyOrder::create([
                'visit_id' => $request->visit_id,
                'radiology_id' => $serviceId,
                'quantity' => 1,
                'price' => $service->price,
                'status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Radiology order(s) created successfully.');
    }
}