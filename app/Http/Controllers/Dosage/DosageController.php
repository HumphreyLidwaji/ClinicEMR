<?php

namespace App\Http\Controllers\Dosage;

use App\Http\Controllers\Controller;
use App\Models\Dosage;
use Illuminate\Http\Request;

class DosageController extends Controller
{
    public function index() {
        $dosages = Dosage::all();
        return view('dosages.index', compact('dosages'));
    }

    public function create() {
        return view('dosages.create');
    }

    public function store(Request $request) {
        $request->validate(['description' => 'required|string|max:255']);
        Dosage::create($request->only('description'));
        return redirect()->route('dosages.index')->with('success', 'Dosage created.');
    }

    public function edit(Dosage $dosage) {
        return view('dosages.edit', compact('dosage'));
    }

    public function update(Request $request, Dosage $dosage) {
        $request->validate(['description' => 'required|string|max:255']);
        $dosage->update($request->only('description'));
        return redirect()->route('dosages.index')->with('success', 'Dosage updated.');
    }
}