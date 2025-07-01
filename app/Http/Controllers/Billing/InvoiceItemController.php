<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Billing\Invoice;
use App\Models\Billing\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function store(Request $request, $invoiceId)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'quantity'    => 'required|integer|min:1',
            'unit_price'  => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::findOrFail($invoiceId);

        $item = InvoiceItem::create([
            'invoice_id'  => $invoice->id,
            'description' => $request->description,
            'quantity'    => $request->quantity,
            'unit_price'  => $request->unit_price,
            'total'       => $request->quantity * $request->unit_price,
        ]);

        // Optionally update invoice total
        $invoice->amount += $item->total;
        $invoice->save();

        return redirect()->back()->with('success', 'Invoice item added.');
    }

    public function destroy($id)
    {
        $item = InvoiceItem::findOrFail($id);
        $invoice = $item->invoice;
        $invoice->amount -= $item->total;
        $invoice->save();
        $item->delete();

        return redirect()->back()->with('success', 'Invoice item removed.');
    }
}