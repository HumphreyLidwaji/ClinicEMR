<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HR\Allowance;

class AllowanceController extends Controller
{
    public function index()
    {
        $allowances = Allowance::all();
        return view('hr.allowances.index', compact('allowances'));
    }

    public function create()
    {
        return view('hr.allowances.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Allowance::create($data);
        return redirect()->route('allowances.index')->with('success', 'Allowance created successfully.');
    }

    public function show(Allowance $allowance)
    {
        return view('hr.allowances.show', compact('allowance'));
    }

    public function edit(Allowance $allowance)
    {
        return view('hr.allowances.edit', compact('allowance'));
    }

    public function update(Request $request, Allowance $allowance)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $allowance->update($data);
        return redirect()->route('allowances.index')->with('success', 'Allowance updated successfully.');
    }

    public function destroy(Allowance $allowance)
    {
        $allowance->delete();
        return redirect()->route('allowances.index')->with('success', 'Allowance deleted successfully.');
    }
}
