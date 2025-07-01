<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\Sale;
use App\Models\DrugBatch;
use Illuminate\Support\Carbon;

use App\Models\StockMovement;

class PharmacyController extends Controller
{
    public function dashboard()
{
    $drugCount = Drug::count();

    $lowStock = Drug::with('stockMovements')->get()->map(function ($drug) {
        $drug->stock = $drug->stockMovements->sum('quantity');
        return $drug;
    })->filter(fn($d) => $d->stock <= $d->reorder_level);
    $lowStockCount = $lowStock->count();

    $todaySalesTotal = Sale::whereDate('created_at', Carbon::today())->sum('total');

    $expiring = DrugBatch::with('drug')
        ->where('quantity', '>', 0)
        ->where('expiry_date', '<=', Carbon::today()->addDays(30))
        ->orderBy('expiry_date')
        ->get();
    $expiringCount = $expiring->count();

    return view('pharmacy.dashboard', compact(
        'drugCount',
        'lowStockCount',
        'todaySalesTotal',
        'expiringCount',
        'lowStock',
        'expiring'
    ));
}
}
