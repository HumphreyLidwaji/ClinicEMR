<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the items.
     */
    public function index()
    {
        $items = Item::with('category')->get();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new item.
     */
    public function create()
    {
        $categories = ItemCategory::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:item_categories,id',
            'unit' => 'required|string|max:50',
            'reorder_level' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'unit' => $request->unit,
            'reorder_level' => $request->reorder_level ?? 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }

    /**
     * Show the form for editing the specified item.
     */
    public function edit(Item $item)
    {
        $categories = ItemCategory::all();
        return view('items.create', compact('item', 'categories'));
    }

    /**
     * Update the specified item in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:item_categories,id',
            'unit' => 'required|string|max:50',
            'reorder_level' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'unit' => $request->unit,
            'reorder_level' => $request->reorder_level ?? 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated.');
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return back()->with('success', 'Item deleted.');
    }
}
