<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Billing\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

public function index()
{
    $invoices = Invoice::with('items')->orderByDesc('created_at')->get();
    return view('billing.invoices', compact('invoices'));
}
public function create()
{
    return view('billing.create_invoice');
}
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        $invoice = Invoice::create([
    'customer_name' => $request->customer_name,
    'amount' => $request->amount,
    'due_date' => $request->due_date,
    'balance_due' => $request->amount,
]);

        return redirect()->route('billing.invoices.show', $invoice->id)
                         ->with('success', 'Invoice created successfully.');
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('billing.edit_invoice', compact('invoice'));
    }
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        $invoice->update($data);
        return redirect()->route('billing.invoices.show', $invoice->id)
                         ->with('success', 'Invoice updated successfully.');
    }
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->route('billing.invoices.index')
                         ->with('success', 'Invoice deleted successfully.');
    }
    

public function show($id)
{
    $invoice = Invoice::with('items')->findOrFail($id);
    return view('billing.view_invoice', compact('invoice'));
}

public function print($id)
{
    $invoice = Invoice::with('items')->findOrFail($id);
    return view('billing.print_invoice', compact('invoice'));
}
    
    public function download($id)
    {
        $invoice = Invoice::findOrFail($id);
        $pdf = \PDF::loadView('billing.invoice_pdf', compact('invoice'));
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }



}