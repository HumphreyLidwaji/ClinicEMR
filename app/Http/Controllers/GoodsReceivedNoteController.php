<?php
namespace App\Http\Controllers;

use App\Models\GoodsReceivedNote;
use App\Models\PurchaseOrder;
use App\Models\Store;
use App\Models\GRNItem;
use Illuminate\Http\Request;

class GoodsReceivedNoteController extends Controller
{
    public function index()
    {
        $grns = GoodsReceivedNote::with(['store', 'purchaseOrder'])->latest()->get();
        return view('grns.index', compact('grns'));
    }

    public function create()
    {
        $purchaseOrders = PurchaseOrder::with('items.item')->where('status', 'pending')->get();
        $stores = Store::all();
        return view('grns.create', compact('purchaseOrders', 'stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'store_id' => 'required|exists:stores,id',
            'received_by' => 'nullable|integer',
            'received_date' => 'nullable|date',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.received_quantity' => 'required|integer|min:1',
        ]);

        $grn = GoodsReceivedNote::create($request->only('purchase_order_id', 'store_id', 'received_by', 'received_date', 'notes'));

        foreach ($request->items as $item) {
            $grn->items()->create($item);
        }

        // Optional: mark PO as 'received'
        $grn->purchaseOrder->update(['status' => 'received']);

        return redirect()->route('grns.index')->with('success', 'GRN created successfully.');
    }

    public function show(GoodsReceivedNote $grn)
    {
        return view('grns.show', compact('grn'));
    }

    public function destroy(GoodsReceivedNote $grn)
    {
        $grn->delete();
        return redirect()->route('grns.index')->with('success', 'GRN deleted.');
    }
}
