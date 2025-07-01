<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\GoodsReceivedNote;
use Illuminate\Http\Request;

class GoodsReceivedNoteController extends Controller
{
    public function index()
    {
        $grns = GoodsReceivedNote::with('purchaseOrder.supplier')->get();
        return view('inventory.goods_received_notes', compact('grns'));
    }

    public function create()
    {
        return view('inventory.create_goods_received_note');
    }

    public function store(Request $request)
    {
        $request->validate([
            'grn_number' => 'required|string|max:255|unique:goods_received_notes,grn_number',
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'received_date' => 'required|date',
        ]);

        GoodsReceivedNote::create($request->all());

        return redirect()->route('inventory.goods_received_notes.index')->with('success', 'Goods Received Note created successfully.');
    }
}