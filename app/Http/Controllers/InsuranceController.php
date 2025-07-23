<?php
namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::latest()->paginate(10);
        return view('insurances.index', compact('insurances'));
    }

   public function create()
{
    $accounts = \App\Models\Account::all();
    return view('insurances.create', compact('accounts'));
}


    public function store(Request $request)
    {
       $request->validate([
    'name' => 'required|string|max:255',
    'code' => 'nullable|string|max:50',
    'phone' => 'nullable|string|max:20',
    'email' => 'nullable|email|max:255',
    'account_id' => 'nullable|exists:accounts,id',
]);


        Insurance::create($request->all());

        return redirect()->route('insurances.index')->with('success', 'Insurance added successfully.');
    }

   public function edit(Insurance $insurance)
{
    $accounts = \App\Models\Account::all();
    return view('insurances.edit', compact('insurance', 'accounts'));
}


    public function update(Request $request, Insurance $insurance)
    {
    $request->validate([
    'name' => 'required|string|max:255',
    'code' => 'nullable|string|max:50',
    'phone' => 'nullable|string|max:20',
    'email' => 'nullable|email|max:255',
    'account_id' => 'nullable|exists:accounts,id',
]);


        $insurance->update($request->all());

        return redirect()->route('insurances.index')->with('success', 'Insurance updated successfully.');
    }

    public function destroy(Insurance $insurance)
    {
        $insurance->delete();
        return redirect()->route('insurances.index')->with('success', 'Insurance deleted.');
    }
}
