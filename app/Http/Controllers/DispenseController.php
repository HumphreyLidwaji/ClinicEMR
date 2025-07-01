<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Visit;
use App\Models\Drug;
use App\Models\DrugBatch;
use App\Models\StockMovement;
use App\Models\Sale;
use Illuminate\Http\Request;

class DispenseController extends Controller
{
public function index()
{
    $visits = Visit::with([
        'patient',
        'prescriptions.drug',
        'prescriptions.dosage',
    ])
    ->whereHas('prescriptions', fn($q) => $q->where('dispensed', false))
    ->get();

    return view('pharmacy.dispense.index', compact('visits'));
}




public function store(Request $request)
{
    foreach ($request->input('items') as $item) {
        $remainingQty = $item['quantity'];

        $batches = DrugBatch::where('drug_id', $item['drug_id'])
            ->where('quantity', '>', 0)
            ->where(function ($q) {
                $q->whereNull('expiry_date')->orWhere('expiry_date', '>=', now());
            })
            ->orderBy('expiry_date')
            ->get();

        foreach ($batches as $batch) {
            if ($remainingQty <= 0) break;

            $deduct = min($batch->quantity, $remainingQty);

            $batch->decrement('quantity', $deduct);

            StockMovement::create([
                'drug_id' => $batch->drug_id,
                'quantity' => -$deduct,
                'reason' => 'dispense',
                'reference_type' => 'drug_batch',
                'reference_id' => $batch->id,
            ]);

            $remainingQty -= $deduct;
        }

        Sale::create([
            'sale_type' => $request->input('type'),
            'visit_id' => $request->input('visit_id'),
            'drug_id' => $item['drug_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'total' => $item['quantity'] * $item['price'],
        ]);

        // Mark prescription as dispensed
        if (!empty($item['prescription_id'])) {
            Prescription::where('id', $item['prescription_id'])->update([
                'dispensed' => true,
            ]);
        }
    }

    return back()->with('success', 'Drugs dispensed from available batches.');
}


// DispenseController.php

public function show($visitId)
{
    $visit = Visit::with(['patient', 'prescriptions.drug'])
        ->findOrFail($visitId);

    return view('pharmacy.dispense.show', compact('visit'));
}

}
