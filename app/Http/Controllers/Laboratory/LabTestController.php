<?php

namespace App\Http\Controllers\Laboratory;

use App\Models\LabTest;
use App\Http\Controllers\Controller;

use App\Models\Account;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    public function index()
    {
        $labTests = LabTest::with('account')->latest()->paginate(20);
        return view('laboratory.lab-tests.index', compact('labTests'));
    }

    public function create()
    {
        $accounts = Account::all();
        return view('laboratory.lab-tests.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'account_id'  => 'required|exists:accounts,id',
        ]);

        LabTest::create($request->only('name', 'price', 'description', 'account_id'));

        return redirect()->route('lab-tests.index')->with('success', 'Lab Test created successfully.');
    }

    public function edit(LabTest $labTest)
    {
        $accounts = Account::all();
        return view('laboratory.lab-tests.edit', compact('labTest', 'accounts'));
    }

    public function update(Request $request, LabTest $labTest)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'account_id'  => 'required|exists:accounts,id',
        ]);

        $labTest->update($request->only('name', 'price', 'description', 'account_id'));

        return redirect()->route('lab-tests.index')->with('success', 'Lab Test updated successfully.');
    }

    public function destroy(LabTest $labTest)
    {
        $labTest->delete();
        return redirect()->route('lab-tests.index')->with('success', 'Lab Test deleted successfully.');
    }
}