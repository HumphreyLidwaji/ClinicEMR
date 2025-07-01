<?php
namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:stores,name',
            'location' => 'nullable|string|max:255',
        ]);

        Store::create($request->all());
        return redirect()->route('stores.index')->with('success', 'Store added successfully.');
    }

    public function edit(Store $store)
    {
        return view('stores.create', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|unique:stores,name,' . $store->id,
            'location' => 'nullable|string|max:255',
        ]);

        $store->update($request->all());
        return redirect()->route('stores.index')->with('success', 'Store updated successfully.');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('stores.index')->with('success', 'Store deleted.');
    }
}
