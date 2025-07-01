<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\RadiologyService;                                   
use App\Models\RadiologyOrder;
use App\Models\RadiologyResult;

use Illuminate\Http\Request;

class RadiologyResultController extends Controller
{

   public function index()
{
    $results = RadiologyResult::with('order.imagingTest', 'order.visit.patient')->latest()->get();

    return view('radiology.results.index', compact('results'));
}

  // Show form to add result for a specific radiology order
public function create($orderId)
{
    $order = RadiologyOrder::with(['visit.patient', 'imagingTest'])->findOrFail($orderId);

    // Extract test name for easier use in the view
    $testName = $order->RadiologyService->name ?? 'N/A';

    return view('radiology.results.create', compact('order', 'testName'));
}


    // Save the radiology result
public function store(Request $request)
{
    $request->validate([
        'order_id'   => 'required|exists:radiology_orders,id',
        'test_name'  => 'required|string|max:255',
        'remarks'    => 'nullable|string',
    ]);

    RadiologyResult::create([
        'order_id'    => $request->order_id,
        'test_name'   => $request->test_name,
        'resulted_by' => auth()->user()->name, // or ->id if you're storing user ID
        'remarks'     => $request->remarks,
    ]);

    return redirect()->route('orders.index')->with('success', 'Radiology result saved successfully.');
}

    

// Show a specific radiology result
public function show($id)
{
    $result = RadiologyResult::with('order.imagingTest', 'order.visit.patient')->findOrFail($id);

    return view('radiology.results.show', compact('result'));

}

    // Show form to edit a specific radiology result
public function edit($id)   
{
    $result = RadiologyResult::with('order.imagingTest', 'order.visit.patient')->findOrFail($id);

    // Extract test name for easier use in the view
    $testName = $result->RadiologyService->name ?? 'N/A';

    return view('radiology.results.edit', compact('result', 'testName'));
}           

    // Update a specific radiology result       
public function update(Request $request, $id)       
{
    $request->validate([
        'test_name' => 'required|string|max:255',
        'remarks'   => 'nullable|string',
    ]);

    $result = RadiologyResult::findOrFail($id);
    $result->update([
        'test_name'   => $request->test_name,
        'remarks'     => $request->remarks,
        'resulted_by' => auth()->user()->name, // or ->id if you're storing user ID
    ]);

    return redirect()->route('radiology.results.index')->with('success', 'Radiology result updated successfully.');
} 

}
