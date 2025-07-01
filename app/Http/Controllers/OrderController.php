<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\LabOrder;
use App\Models\RadiologyOrder;
use App\Models\ServiceOrder;
use App\Models\ProcedureOrder;
use App\Models\Visit;
use App\Models\LabTest; 
use App\Models\RadiologyService;
class OrderController extends Controller
{

    public function storeItem(Request $request, $type)
{
    $request->validate([
        'item_id' => 'required|numeric',
        'visit_id' => 'required|exists:visits,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $visitId = $request->visit_id;
    $quantity = $request->quantity;

    $item = match ($type) {
        'lab' => \App\Models\LabTest::findOrFail($request->item_id),
        'radiology' => \App\Models\RadiologyService::findOrFail($request->item_id),
        'service' => \App\Models\Service::findOrFail($request->item_id),
        'procedure' => \App\Models\Procedure::findOrFail($request->item_id),
        default => abort(404),
    };

    $orderClass = match ($type) {
        'lab' => \App\Models\LabOrder::class,
        'radiology' => \App\Models\RadiologyOrder::class,
        'service' => \App\Models\ServiceOrder::class,
        'procedure' => \App\Models\ProcedureOrder::class,
    };

    $order = $orderClass::create([
        'visit_id' => $visitId,
        $type . '_id' => $item->id,
        'quantity' => $quantity,
        'price' => $item->price,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', ucfirst($type) . ' order added.');
}

    public function edit($type, $id)
    {
        $order = null;
        $view = 'orders.partials.edit'; // Make sure this view exists

        switch ($type) {
            case 'lab':
                $order = LabOrder::with('labTest')->findOrFail($id);
                break;
            case 'radiology':
                $order = RadiologyOrder::with('radiologyService')->findOrFail($id);
                break;
            case 'service':
                $order = ServiceOrder::with('service')->findOrFail($id);
                break;
            case 'procedure':
                $order = ProcedureOrder::with('procedure')->findOrFail($id);
                break;
            default:
                abort(404, 'Unknown order type');
        }

        return view($view, compact('order', 'type'));
    }



// Get available items
public function getItems($type)
{
    return match ($type) {
        'lab' => \App\Models\LabTest::select('id', 'name', 'price')->get(),
        'radiology' => \App\Models\RadiologyService::select('id', 'name', 'price')->get(),
        'service' => \App\Models\Service::select('id', 'name', 'price')->get(),
        'procedure' => \App\Models\Procedure::select('id', 'name', 'price')->get(),
        default => abort(404),
    };
}

// Update item
public function updateItem(Request $request, $type, $id)
{
    $request->validate([
        'item_id' => 'required|numeric',
    ]);

    $order = match ($type) {
        'lab' => \App\Models\LabOrder::findOrFail($id),
        'radiology' => \App\Models\RadiologyOrder::findOrFail($id),
        'service' => \App\Models\ServiceOrder::findOrFail($id),
        'procedure' => \App\Models\ProcedureOrder::findOrFail($id),
        default => abort(404),
    };

    if ($order->status !== 'pending') {
        return back()->with('error', 'Cannot edit billed orders.');
    }

    // Update item reference and price
    $order->{$type . '_id'} = $request->item_id;
    $price = match ($type) {
        'lab' => \App\Models\LabTest::find($request->item_id)?->price,
        'radiology' => \App\Models\RadiologyService::find($request->item_id)?->price,
        'service' => \App\Models\Service::find($request->item_id)?->price,
        'procedure' => \App\Models\Procedure::find($request->item_id)?->price,
    };

    $order->price = $price ?? 0;
    $order->save();

    return redirect()->back()->with('success', 'Order updated.');
}

}
