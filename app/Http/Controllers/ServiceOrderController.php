<?php
// filepath: app/Http/Controllers/ServiceOrderController.php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
        ]);

        foreach ($request->services as $serviceId) {
            $service = Service::find($serviceId);
            ServiceOrder::create([
                'visit_id' => $request->visit_id,
                'service_id' => $serviceId,
                'quantity' => 1,
                'price' => $service->price,
                'status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Service order(s) created successfully.');
    }
}