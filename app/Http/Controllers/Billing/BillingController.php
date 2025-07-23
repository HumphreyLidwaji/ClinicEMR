<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\LabOrder;
use App\Models\RadiologyOrder;
use App\Models\ServiceOrder;
use App\Models\ProcedureOrder;
use App\Models\Billing\Invoice;
use App\Models\Billing\InvoiceItem; 
use App\Models\RadiologyService;
use App\Models\Service;
use App\Models\Procedure;

use App\Models\Billing;
use App\Models\Visit;

use Illuminate\Http\Request;

class BillingController extends Controller
{


public function create()
{
    $visits = Visit::with('patient')->get();
    $labs = LabTest::all(); // or your actual Lab model
    $radiology = RadiologyService::all(); // or your actual Radiology model
    $services = Service::all(); // or your actual Service model
    $procedures = Procedure::all(); // or your actual Procedure model

    return view('visits.billing', compact('visits', 'labs', 'radiology', 'services', 'procedures'));
}

public function store(Request $request)
{
    $request->validate([
        'visit_id' => 'required|exists:visits,id',
        'services' => 'required|array|min:1',
        'services.*' => 'exists:services,id',
        'total'    => 'required|numeric|min:0',
    ]);

    foreach ($request->services as $serviceId) {
        $service = \App\Models\Service::find($serviceId);
        \App\Models\Billing::create([
            'visit_id' => $request->visit_id,
            'services' => $serviceId, // Store the service ID or name as needed
            'total'    => $service->price, // Store the price for this service
        ]);
    }

    return redirect()->back()->with('success', 'Invoice generated successfully.');
}

public function show($id)
{
    $billing = Billing::with('visit.patient')->findOrFail($id);
    return view('visits.billing_show', compact('billing'));
}

public function showVisitOrders($visitId)
{
    $visit = Visit::findOrFail($visitId);
   
    $labOrders = LabOrder::where('visit_id', $visitId)->where('status', 'pending')->get();
    $radiologyOrders = RadiologyOrder::where('visit_id', $visitId)->where('status', 'pending')->get();
    $serviceOrders = ServiceOrder::where('visit_id', $visitId)->where('status', 'pending')->get();
    $procedureOrders = ProcedureOrder::where('visit_id', $visitId)->where('status', 'pending')->get();

    // Check for active invoice for this visit
    $invoice = Invoice::where('visit_id', $visitId)->where('status', 'Unpaid')->first();

    return view('billing.visit-orders', compact(
        'visit', 'labOrders', 'radiologyOrders', 'serviceOrders', 'procedureOrders', 'invoice'
    ));
}

public function billSelectedOrders(Request $request, $visitId)
{
    $request->validate([
        'orders' => 'required|array|min:1',
        'quantities' => 'required|array',
        'prices' => 'required|array',
    ]);

  $visit = Visit::findOrFail($visitId);

// Check if an invoice with 'Paid' status already exists
$existingInvoice = Invoice::where('visit_id', $visitId)
                           ->where('status', 'Paid')
                           ->first();

if ($existingInvoice) {
    return redirect()->back()->with('error', 'Invoice has already been Paid/Closed for this visit.');
}


// Find or create an active invoice with 'Unpaid' status
$invoice = Invoice::firstOrCreate(
    ['visit_id' => $visitId, 'status' => 'Unpaid'],
    ['patient_id' => $visit->patient_id]
);


    // Auto-generate invoice number if not present
    if (!$invoice->invoice_number) {
        $last = Invoice::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        $invoice->invoice_number = 'INV-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        $invoice->save();
    }

    foreach ($request->orders as $orderKey) {
        // orderKey format: "lab_12" or "service_4"
        if (!strpos($orderKey, '_')) continue;

        [$type, $id] = explode('_', $orderKey);

        $quantity = $request->quantities[$orderKey] ?? 1;
        $price = $request->prices[$orderKey] ?? 0;

        $o = null;
        $desc = '';
        $revenueAccountId = null;

        switch ($type) {
            case 'lab':
                $o = \App\Models\LabOrder::with('labTest')->find($id);
                if (!$o || !$o->labTest) continue;
                $desc = $o->labTest->name;
                $revenueAccountId = $o->labTest->revenue_account_id ?? null;
                break;

            case 'radiology':
                $o = \App\Models\RadiologyOrder::with('radiologyService')->find($id);
                if (!$o || !$o->radiologyService) continue;
                $desc = $o->radiologyService->name;
                $revenueAccountId = $o->radiologyService->revenue_account_id ?? null;
                break;

            case 'service':
                $o = \App\Models\ServiceOrder::with('service')->find($id);
                if (!$o || !$o->service) continue;
                $desc = $o->service->name;
                $revenueAccountId = $o->service->revenue_account_id ?? null;
                break;

            case 'procedure':
                $o = \App\Models\ProcedureOrder::with('procedure')->find($id);
                if (!$o || !$o->procedure) continue;
                $desc = $o->procedure->name;
                $revenueAccountId = $o->procedure->revenue_account_id ?? null;
                break;

            default:
                continue 2;
        }

        // Only bill if still pending
        if ($o && $o->status == 'pending') {
            \App\Models\Billing\InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $desc,
                'quantity' => $quantity,
                'unit_price' => $price,
                'total' => $quantity * $price,
                'status' => 'pending',
                'revenue_account_id' => $revenueAccountId,
            ]);

            // Update order record with final billed quantity and price
            $o->update([
                'quantity' => $quantity,
                'price' => $price,
                'status' => 'billed',
            ]);
        }
    }

    // Update invoice totals
    $invoice->amount = $invoice->items()->sum('total');
    $invoice->balance_due = $invoice->amount - $invoice->amount_paid;
    $invoice->save();

    return redirect()->route('billing.visit-orders', $visitId)
        ->with('success', 'Selected orders billed successfully.');
}


}