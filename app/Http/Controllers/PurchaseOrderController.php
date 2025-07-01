<?php
namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Item;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $orders = PurchaseOrder::with('items.item')->orderByDesc('id')->get();
        return view('purchase_orders.index', compact('orders'));
    }

    public function create()
    {
        $items = Item::all();
        return view('purchase_orders.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'expected_date' => 'nullable|date',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $order = PurchaseOrder::create($request->only('supplier_name', 'order_date', 'expected_date'));

        foreach ($request->items as $row) {
            $order->items()->create($row);
        }

        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order created.');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.show', compact('purchaseOrder'));
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return back()->with('success', 'Purchase order deleted.');
    }
}
