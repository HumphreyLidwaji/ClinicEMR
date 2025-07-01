<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Drug;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class SalesController extends Controller
{
public function index()
{
    $sales = Sale::with('drug')  // Eager load the drug relationship
                  ->where('sale_type', 'otc')
                  ->latest()
                  ->get();

    return view('pharmacy.sales.index', compact('sales'));
}


public function create()
{
    $drugs = Drug::where('is_active', 1)->get();
    return view('pharmacy.sales.create', compact('drugs'));
}


public function store(Request $request)
{
    $request->validate([
        'drug_id' => 'required|exists:drugs,id',
        'quantity' => 'required|numeric|min:1',
        'price' => 'required|numeric|min:0.01',
    ]);

    $total = $request->quantity * $request->price;

    $sale = Sale::create([
        'sale_type' => 'otc',
        'drug_id' => $request->drug_id,
        'quantity' => $request->quantity,
        'price' => $request->price,
        'total' => $total,
    ]);

    StockMovement::create([
        'drug_id' => $request->drug_id,
        'quantity' => -1 * $request->quantity,
        'reason' => 'sale',
        'reference_id' => $sale->id,
        'reference_type' => 'sale',
    ]);

    return redirect()->route('sales.index')->with('success', 'Sale recorded.');
}


}
