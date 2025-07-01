<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('inventory.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('inventory.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        Category::create($request->only('name'));
        return redirect()->route('inventory.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('inventory.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);
        $category->update($request->only('name'));
        return redirect()->route('inventory.categories.index')->with('success', 'Category updated.');
    }
}