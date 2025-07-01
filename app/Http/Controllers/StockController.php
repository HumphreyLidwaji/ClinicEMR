<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\DrugBatch;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Drug::all();
        $drugs = Drug::with('stockMovements')->get();

        return view('pharmacy.stock.index', compact('stocks','drugs'));
    }
        
    public function create()
    {
        $drugs = Drug::where('is_active', 1)->get();
return view('pharmacy.stock.create', compact('drugs'));

    }
    public function edit($id)
    {
        $drug = Drug::findOrFail($id);
        return view('pharmacy.stock.edit', compact('drug'));
    }

    public function store(Request $request)
    {
        StockMovement::create([
    'drug_id' => $request->drug_id,
    'quantity' => $request->quantity, // positive or negative
    'reason' => $request->reason ?? 'manual_adjustment',
]);
 return view('pharmacy.stock.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $drug = Drug::findOrFail($id);
        $drug->quantity = $request->quantity;
        $drug->save();

        return redirect()->route('pharmacy.stock.index')->with('success', 'Stock updated.');
    }

    public function receive()
{
    $drugs = Drug::where('is_active', 1)->get();
    return view('pharmacy.stock.receive', compact('drugs'));
}
    public function receiveStore(Request $request)
{
    $validated = $request->validate([
        'drug_id' => 'required|exists:drugs,id',
        'batch_number' => 'required|string|max:255',
        'expiry_date' => 'nullable|date',
        'quantity' => 'required|integer|min:1',
        'unit_price' => 'nullable|numeric|min:0',
    ]);

    $batch = DrugBatch::create([
        'drug_id' => $validated['drug_id'],
        'batch_number' => $validated['batch_number'],
        'expiry_date' => $validated['expiry_date'],
        'quantity' => $validated['quantity'],
        'unit_price' => $validated['unit_price'],
        'source_type' => 'manual',
        'source_id' => null,
    ]);

    // Also update stock movements
    StockMovement::create([
        'drug_id' => $batch->drug_id,
        'quantity' => $batch->quantity,
        'reason' => 'receive',
        'reference_type' => 'drug_batch',
        'reference_id' => $batch->id,
    ]);

    return redirect()->route('stock.index')->with('success', 'Stock received and batch recorded.');
}

}
