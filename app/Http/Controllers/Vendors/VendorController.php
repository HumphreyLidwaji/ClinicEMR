<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Models\Vendors\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('system_administration.inventory_set_up.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('system_administration.inventory_set_up.vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:50',
            'email'          => 'nullable|email|max:255',
        ]);
        Vendor::create($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor added.');
    }

    public function edit(Vendor $vendor)
    {
        return view('system_administration.inventory_set_up.vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:50',
            'email'          => 'nullable|email|max:255',
        ]);
        $vendor->update($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor updated.');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted.');
    }
}