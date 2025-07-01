<?php

namespace App\Http\Controllers\Drug;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function index() {
        $drugs = Drug::all();
        return view('drugs.index', compact('drugs'));
    }

    public function create() {
        return view('drugs.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        Drug::create($request->only('name'));
        return redirect()->route('drugs.index')->with('success', 'Drug created.');
    }

    public function edit(Drug $drug) {
        return view('drugs.edit', compact('drug'));
    }

    public function update(Request $request, Drug $drug) {
        $request->validate(['name' => 'required|string|max:255']);
        $drug->update($request->only('name'));
        return redirect()->route('drugs.index')->with('success', 'Drug updated.');
    }
}