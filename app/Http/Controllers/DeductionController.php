<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    public function index()
    {
        $deductions = Deduction::all();
        return view('deductions.index', compact('deductions'));
    }

    public function create()
    {
        return view('deductions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:deductions',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
        ]);

        Deduction::create($request->all());

        return redirect()->route('deductions.index')->with('success', 'Deduction rule created.');
    }

    public function edit(Deduction $deduction)
    {
        return view('deductions.edit', compact('deduction'));
    }

    public function update(Request $request, Deduction $deduction)
    {
        $request->validate([
            'name' => 'required|unique:deductions,name,' . $deduction->id,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
        ]);

        $deduction->update($request->all());

        return redirect()->route('deductions.index')->with('success', 'Deduction rule updated.');
    }

    public function destroy(Deduction $deduction)
    {
        $deduction->delete();
        return redirect()->route('deductions.index')->with('success', 'Deduction deleted.');
    }
}
