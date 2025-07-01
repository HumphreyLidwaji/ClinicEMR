<?php
// filepath: app/Http/Controllers/ProcedureOrderController.php

namespace App\Http\Controllers;

use App\Models\ProcedureOrder;
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:procedures,id',
        ]);

        foreach ($request->services as $procedureId) {
            $procedure = Procedure::find($procedureId);
            ProcedureOrder::create([
                'visit_id' => $request->visit_id,
                'procedure_id' => $procedureId,
                'quantity' => 1,
                'price' => $procedure->price,
                'status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Procedure order(s) created successfully.');
    }
}