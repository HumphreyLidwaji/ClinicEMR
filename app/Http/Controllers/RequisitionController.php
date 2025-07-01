<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\Item;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    public function index()
    {
        $requisitions = Requisition::with('store', 'requestedBy', 'approvedBy')->latest()->get();
        return view('requisitions.index', compact('requisitions'));
    }

    public function create()
    {
        $stores = Store::all();
        $items = Item::where('is_active', 1)->get();
        return view('requisitions.create', compact('stores', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $requisition = Requisition::create([
            'store_id' => $request->store_id,
            'status' => 'pending',
            'notes' => $request->notes,
            'requested_by' => Auth::id(),
        ]);

        foreach ($request->items as $item) {
            RequisitionItem::create([
                'requisition_id' => $requisition->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'remarks' => $item['remarks'] ?? null,
            ]);
        }

        return redirect()->route('requisitions.index')->with('success', 'Requisition submitted.');
    }

    public function show(Requisition $requisition)
    {
        $requisition->load('items.item', 'store', 'requestedBy', 'approvedBy');
        return view('requisitions.show', compact('requisition'));
    }

    public function destroy(Requisition $requisition)
    {
        $requisition->delete();
        return back()->with('success', 'Requisition deleted.');
    }

    public function approve(Requisition $requisition)
    {
        $requisition->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Requisition approved.');
    }
}
