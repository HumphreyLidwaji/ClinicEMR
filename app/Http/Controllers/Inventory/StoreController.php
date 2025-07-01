<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $locations = Store::all();
        return view('system_administration.inventory_set_up.store_locations.index', compact('locations'));
    }

    public function create()
    {
        return view('system_administration.inventory_set_up.store_locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'manager_name' => 'nullable|string|max:255',
        ]);
        Store::create($request->all());
        return redirect()->route('store-locations.index')->with('success', 'Store location added.');
    }

    public function edit(Store $store)
    {
        return view('system_administration.inventory_set_up.store_locations.edit', ['location' => $store]);
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'manager_name' => 'nullable|string|max:255',
        ]);
        $store->update($request->all());
        return redirect()->route('store-locations.index')->with('success', 'Store location updated.');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('store-locations.index')->with('success', 'Store location deleted.');
    }
}