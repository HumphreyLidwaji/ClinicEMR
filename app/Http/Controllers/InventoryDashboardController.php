<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemStock;
use App\Models\GoodsReceivedNote;
use App\Models\ItemTransfer;
use App\Models\StockAdjustment;
use Illuminate\Http\Request;

class InventoryDashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalQuantity = ItemStock::sum('quantity');
        $totalStockValue = Item::with('stocks')->get()->sum(function ($item) {
            return $item->stocks->sum(fn($s) => $s->quantity * $item->unit_price);
        });

        $lowStockItems = Item::with('stocks')->whereColumn('quantity', '<', 'reorder_level')->get();

        $recentGRNs = GoodsReceivedNote::latest()->take(5)->with('store')->get();
        $recentTransfers = ItemTransfer::latest()->take(5)->with('item')->get();

        $stockPerStore = ItemStock::with('item', 'store')->get()->groupBy('store_id');

        return view('inventory.dashboard', compact(
            'totalItems', 'totalQuantity', 'totalStockValue',
            'lowStockItems', 'recentGRNs', 'recentTransfers', 'stockPerStore'
        ));
    }
}
