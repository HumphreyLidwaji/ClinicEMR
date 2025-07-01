<?php

namespace App\Http\Controllers\Laboratory;

use App\Http\Controllers\Controller;
use App\Models\Laboratory\SampleCollection;
use App\Models\LabOrder;
use App\Models\Patient;

use Illuminate\Http\Request;

class SampleCollectionController extends Controller
{
    public function index()
{
    $sampleCollections = SampleCollection::with('order.visit.patient')->latest()->paginate(10);
    return view('laboratory.sample_collections.index', compact('sampleCollections'));
}

   public function create($orderId)
{
    return view('laboratory.sample_collections.create', compact('orderId'));
}


  public function store(Request $request)
{
    $validated = $request->validate([
        'order_id' => 'required|integer|exists:lab_orders,id', 
        'sample_type' => 'required|string|max:255',
        'collected_at' => 'nullable|date',
    ]);

    SampleCollection::create([
        'order_id'     => $validated['order_id'],
        'sample_type'  => $validated['sample_type'],
        'collected_at' => $validated['collected_at'] ?? now(),
    ]);

    return redirect()->route('sample_collections.index')->with('success', 'Sample collected successfully.');
}

   

  
}