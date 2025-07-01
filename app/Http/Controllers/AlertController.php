<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\DrugBatch;

class AlertController extends Controller
{
    /**
     * Display pharmacy alerts for low stock and near expiry.
     */
    public function pharmacyAlerts()
    {
        // Get all drugs with current stock
        $drugs = Drug::with('stockMovements')->get();

        // Calculate current stock for each drug
        $lowStock = $drugs->map(function ($drug) {
            $drug->stock = $drug->stockMovements->sum('quantity');
            return $drug;
        })->filter(fn($d) => $d->stock <= $d->reorder_level);

        // Get batches that are expiring in 30 days or already expired
        $nearExpiry = DrugBatch::where('expiry_date', '<=', now()->addDays(30))
            ->where('quantity', '>', 0)
            ->with('drug')
            ->orderBy('expiry_date')
            ->get();

       return view('pharmacy.alerts.alerts', compact('lowStock', 'nearExpiry'));
    }
}

