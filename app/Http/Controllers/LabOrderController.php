<?php


namespace App\Http\Controllers;

use App\Models\LabOrder;
use App\Models\Visit;
use App\Models\LabTest;
use Illuminate\Http\Request;

class LabOrderController extends Controller
{
    public function index()
    {
        
        $orders = LabOrder::with(['visit', 'labTest'])->get();
        return view('laboratory.lab_orders.index', compact('orders'));
    }

    public function create()
    {
        $visits = Visit::all();
        $labs = LabTest::all();
        return view('laboratory.lab_orders.create', compact('visits', 'labs'));
    }


// app/Http/Controllers/LabOrderController.php
public function store(Request $request)
{
    $request->validate([
        'visit_id' => 'required|exists:visits,id',
        'services' => 'required|array|min:1',
        'services.*' => 'exists:lab_tests,id',
    ]);

    foreach ($request->services as $labTestId) {
        $lab = \App\Models\LabTest::find($labTestId);
        \App\Models\LabOrder::create([
            'visit_id' => $request->visit_id,
            'lab_test_id' => $labTestId,
            'quantity' => 1,
            'price' => $lab->price,
            'status' => 'pending',
        ]);
    }

    return redirect()->back()->with('success', 'Lab order(s) created successfully.');
}

    // Add edit, update, destroy as needed
}