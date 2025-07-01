<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\StockTransfer;
use App\Models\Inventory\Item;
use App\Models\Inventory\Store;
use Illuminate\Http\Request;

class StockTransferController extends Controller
{
    public function index()
    {
        $transfers = StockTransfer::with(['item', 'fromStore', 'toStore'])->get();
        return view('inventory.stock_transfers', compact('transfers'));
    }

    public function create()
    {
        $items = Item::all();
        $stores = Store::all();
        return view('inventory.stocktransfer/create', compact('items', 'stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'from_store_id' => 'required|exists:stores,id|different:to_store_id',
            'to_store_id' => 'required|exists:stores,id|different:from_store_id',
            'quantity' => 'required|integer|min:1',
            'transfer_date' => 'required|date',
        ]);

        StockTransfer::create($request->all());

        return redirect()->route('inventory.transfers')->with('success', 'Stock transfer recorded.');
    }

    public function show($id)
    {
        $transfer = StockTransfer::with(['item', 'fromStore', 'toStore'])->findOrFail($id);
        return view('inventory.show_stock_transfer', compact('transfer'));
    }

    public function edit($id)
    {
        $transfer = StockTransfer::findOrFail($id);
        $items = Item::all();
        $stores = Store::all();
        return view('inventory.edit_stock_transfer', compact('transfer', 'items', 'stores'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'from_store_id' => 'required|exists:stores,id|different:to_store_id',
            'to_store_id' => 'required|exists:stores,id|different:from_store_id',
            'quantity' => 'required|integer|min:1',
            'transfer_date' => 'required|date',
        ]);

        $transfer = StockTransfer::findOrFail($id);
        $transfer->update($request->all());

        return redirect()->route('inventory.transfers.index')->with('success', 'Stock transfer updated.');
}

}