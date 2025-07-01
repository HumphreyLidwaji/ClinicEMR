<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Item;
use App\Models\Inventory\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();
        return view('inventory.items', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('inventory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'sku'       => 'required|string|max:100|unique:items,sku',
            'category_id' => 'nullable|exists:categories,id',
            'stock'     => 'required|integer|min:0',
            'unit'      => 'required|string|max:50',
        ]);

        Item::create($request->all());

        return redirect()->route('inventory.items.index')->with('success', 'Item added successfully.');
    }
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('inventory.edit_item', compact('item', 'categories'));
    }
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'sku'       => 'required|string|max:100|unique:items,sku,' . $item->id,
            'category_id' => 'nullable|exists:categories,id',
            'stock'     => 'required|integer|min:0',
            'unit'      => 'required|string|max:50',
        ]);

        $item->update($request->all());

        return redirect()->route('inventory.items.index')->with('success', 'Item updated successfully.');
    }
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('inventory.items.index')->with('success', 'Item deleted successfully.');
    }
    public function show(Item $item)
    {
        return view('inventory.show_item', compact('item'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = Item::with('category')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('sku', 'like', '%' . $query . '%')
            ->get();

        return view('inventory.items', compact('items'));
    }
    public function stockReport()
    {
        $items = Item::with('category')->get();
        return view('inventory.stock_report', compact('items'));
    }

    public function lowStockReport()
    {
        $items = Item::with('category')
            ->where('stock', '<=', 5) // Assuming 5 is the threshold for low stock
            ->get();
        return view('inventory.low_stock_report', compact('items'));
    }
    public function categoryReport()
    {
        $categories = Category::with('items')->get();
        return view('inventory.category_report', compact('categories'));
    }

    public function itemHistory(Item $item)
    {
        // Assuming you have a history or logs table to track item changes
        $history = $item->history()->get(); // Adjust according to your model's relationship
        return view('inventory.item_history', compact('item', 'history'));
    }
}