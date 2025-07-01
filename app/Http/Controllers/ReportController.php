<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sale;

use App\Models\Drug;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function sales(Request $request)
{
    $sales = Sale::with('drug')
        ->when($request->start_date, fn($q) => $q->whereDate('created_at', '>=', $request->start_date))
        ->when($request->end_date, fn($q) => $q->whereDate('created_at', '<=', $request->end_date))
        ->latest()->get();

    return view('pharmacy.reports.sales_report', compact('sales'));
}

public function stock()
{
    $drugs = Drug::with('stockMovements')->get();
    return view('pharmacy.reports.stock_report', compact('drugs'));
}

public function expiry()
{
    $drugs = Drug::whereNotNull('expiry_date')->get();
    return view('pharmacy.reports.expiry_report', compact('drugs'));
}


}
