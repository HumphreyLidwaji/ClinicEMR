<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Billing\Payment;
use Illuminate\Http\Request;
 use App\Models\Insurance;
 use App\Models\Transaction;
use App\Models\Account;
use App\Models\Billing\Invoice;
use App\Models\PaymentItem;


class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderByDesc('paid_at')->get();
        return view('billing.payments', compact('payments'));
    }

  

public function create($invoiceId = null)
{
    // Get the specific invoice only
    $invoices = collect(); // empty by default

    if ($invoiceId) {
        $invoice = \App\Models\Billing\Invoice::find($invoiceId);
        if ($invoice) {
            $invoices->push($invoice);
        }
    }

    $insurances = \App\Models\Insurance::all();

    return view('billing.payments.create', compact('invoices', 'insurances', 'invoiceId'));
}





public function store(Request $request)
{
    $request->validate([
        'invoice_id' => 'required|exists:invoices,id',
        'method' => 'required|string',
        'amount' => 'required|numeric|min:0.01',
        'insurance_id' => 'nullable|exists:insurances,id',
        'items' => 'required|array',
        'items.*.id' => 'required|exists:invoice_items,id',
        'items.*.amount_paid' => 'required|numeric|min:0',
    ]);

    // Generate payment number
    $lastPayment = \App\Models\Billing\Payment::orderBy('id', 'desc')->first();
    $nextNumber = ($lastPayment && preg_match('/PMT-(\d+)/', $lastPayment->payment_number, $m)) ? intval($m[1]) + 1 : 1;
    $paymentNumber = 'PMT-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

    $invoice = Invoice::findOrFail($request->invoice_id);

    $payment = new Payment();
    $payment->invoice_number = $invoice->invoice_number;
    $payment->method = $request->method;
    $payment->amount = $request->amount;
    $payment->patient_name = $invoice->patient_name;
    $payment->insurance_id = $request->insurance_id;
    $payment->payment_number = $paymentNumber;

    if ($request->insurance_id) {
        $insurance = Insurance::find($request->insurance_id);
        $payment->account_id = $insurance?->account_id;
    }

    $payment->save();

    // Track total paid to update invoice summary
    $totalItemPayment = 0;

    foreach ($request->items as $itemData) {
        $item = \App\Models\Billing\InvoiceItem::find($itemData['id']);
        $amountPaid = floatval($itemData['amount_paid']);
        if ($amountPaid <= 0) continue;

        // Save payment item
        \App\Models\PaymentItem::create([
            'payment_id' => $payment->id,
            'invoice_item_id' => $item->id,
            'amount_paid' => $amountPaid,
        ]);

        // Update invoice item
        $item->amount_paid += $amountPaid;
        $item->status = ($item->amount_paid >= $item->total) ? 'paid' : 'partial';
        $item->save();

        // Credit revenue account
        if ($item->revenue_account_id) {
            Transaction::create([
                'account_id' => $item->revenue_account_id,
                'type' => 'credit',
                'amount' => $amountPaid,
                'description' => 'Revenue for item: ' . $item->description,
                'date' => now(),
            ]);

            // Optional: update revenue account balance
            $account = \App\Models\Account::find($item->revenue_account_id);
            if ($account) {
                $account->account_balance += $amountPaid;
                $account->save();
            }
        }

        $totalItemPayment += $amountPaid;
    }

    // Update invoice summary
    $invoice->amount_paid += $totalItemPayment;
    $invoice->balance_due = max(0, $invoice->amount - $invoice->amount_paid);
    $invoice->status = $invoice->balance_due == 0 ? 'paid' : ($invoice->amount_paid > 0 ? 'partial' : 'unpaid');
    $invoice->save();

    // Debit payment method account (e.g., Cash/Mpesa)
    $cashAccount = Account::where('name', $request->method)->first();
    if ($cashAccount) {
        Transaction::create([
            'account_id' => $cashAccount->id,
            'type' => 'debit',
            'amount' => $payment->amount,
            'description' => 'Payment received for Invoice #' . $payment->invoice_number,
            'date' => now(),
        ]);
        $cashAccount->account_balance += $payment->amount;
        $cashAccount->save();
    }

    // Credit payer (Insurance or Patient Receivables)
    $payerAccount = $payment->account_id
        ? Account::find($payment->account_id)
        : Account::where('name', 'Patient Receivables')->first();

    if ($payerAccount) {
        Transaction::create([
            'account_id' => $payerAccount->id,
            'type' => 'credit',
            'amount' => $payment->amount,
            'description' => 'Settlement for Invoice #' . $payment->invoice_number,
            'date' => now(),
        ]);
        $payerAccount->account_balance -= $payment->amount;
        $payerAccount->save();
    }

    return redirect()->route('billing.payments.index')->with('success', 'Payment posted per item and recorded in ledger.');
}



    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view('billing.payment_show', compact('payment'));
    }

        

    // Add create, store, show, etc. as needed
}