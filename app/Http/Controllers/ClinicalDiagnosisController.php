<?php

namespace App\Http\Controllers;

use App\Models\ClinicalDiagnosis;
use Illuminate\Http\Request;

class ClinicalDiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ClinicalDiagnosis::all();
        return view('clinical-diagnoses.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clinical_diagnoses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        ClinicalDiagnosis::create($request->all());
        return redirect()->route('clinical-diagnoses.index')->with('success', 'Clinical diagnosis added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = ClinicalDiagnosis::findOrFail($id);
        return view('clinical_diagnoses.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = ClinicalDiagnosis::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        $item->update($request->all());
        return redirect()->route('clinical-diagnoses.index')->with('success', 'Clinical diagnosis updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ClinicalDiagnosis::destroy($id);
        return redirect()->route('clinical-diagnoses.index')->with('success', 'Clinical diagnosis deleted.');
    }
}
