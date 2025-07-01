<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\PurchaseOrder;
use App\Models\Vendors\Vendor;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('supplier')->get();
        return view('inventory.purchase_orders', compact('purchaseOrders'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        return view('inventory.purchaseorder.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'po_number'     => 'required|string|max:50|unique:purchase_orders,po_number',
            'supplier_id'   => 'required|exists:vendors,id',
            'status'        => 'required|string|max:50',
            'expected_date' => 'required|date',
        ]);

        PurchaseOrder::create($request->all());

        return redirect()->route('inventory.purchase_orders.index')->with('success', 'Purchase Order created.');
    }
}