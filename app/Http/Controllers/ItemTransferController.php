<?php
namespace App\Http\Controllers;

use App\Models\ItemTransfer;
use App\Models\Item;
use App\Models\Store;
use App\Models\ItemStock;
use Illuminate\Http\Request;

class ItemTransferController extends Controller
{
    public function index()
    {
        $transfers = ItemTransfer::with(['item', 'fromStore', 'toStore'])->latest()->get();
        return view('transfers.index', compact('transfers'));
    }

    public function create()
    {
        $items = Item::all();
        $stores = Store::all();
        return view('transfers.create', compact('items', 'stores'));
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

        // Check if sufficient stock exists in the from_store
        $fromStock = ItemStock::where([
            'item_id' => $request->item_id,
            'store_id' => $request->from_store_id,
        ])->first();

        if (!$fromStock || $fromStock->quantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock in source store.'])->withInput();
        }

        // Perform stock update
        $fromStock->decrement('quantity', $request->quantity);
        ItemStock::updateOrCreate(
            ['item_id' => $request->item_id, 'store_id' => $request->to_store_id],
            ['quantity' => \DB::raw('quantity + ' . $request->quantity)]
        );

        // Log the transfer
        ItemTransfer::create([
            'item_id' => $request->item_id,
            'from_store_id' => $request->from_store_id,
            'to_store_id' => $request->to_store_id,
            'quantity' => $request->quantity,
            'transfer_date' => $request->transfer_date,
            'notes' => $request->notes,
            'transferred_by' => auth()->id(),
        ]);

        return redirect()->route('transfers.index')->with('success', 'Stock transferred successfully.');
    }
}
