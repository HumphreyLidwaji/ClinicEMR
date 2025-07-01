<?php
namespace App\Http\Controllers;

use App\Models\StockAdjustment;
use App\Models\ItemStock;
use App\Models\Item;
use App\Models\Store;
use Illuminate\Http\Request;

class StockAdjustmentController extends Controller
{
    public function index()
    {
        $adjustments = StockAdjustment::with(['item', 'store'])->latest()->get();
        return view('adjustments.index', compact('adjustments'));
    }

    public function create()
    {
        $items = Item::all();
        $stores = Store::all();
        return view('adjustments.create', compact('items', 'stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'store_id' => 'required|exists:stores,id',
            'adjustment_type' => 'required|in:damage,loss,correction,opening',
            'quantity' => 'required|integer|not_in:0',
            'reason' => 'nullable|string',
        ]);

        // Apply adjustment
        $stock = ItemStock::firstOrCreate(
            ['item_id' => $request->item_id, 'store_id' => $request->store_id],
            ['quantity' => 0]
        );

        $stock->quantity += $request->quantity;
        $stock->save();

        StockAdjustment::create([
            'item_id' => $request->item_id,
            'store_id' => $request->store_id,
            'adjustment_type' => $request->adjustment_type,
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'adjusted_by' => auth()->id(),
        ]);

        return redirect()->route('adjustments.index')->with('success', 'Stock adjusted successfully.');
    }
}
