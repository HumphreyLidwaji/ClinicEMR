<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    public function index()
    {
        $counties = County::all();
        return view('counties.index', compact('counties'));
    }

    public function create()
    {
        return view('counties.create');
    }

    public function store(Request $request)
    {
        $request->validate(['county_name' => 'required']);
        County::create($request->all());
        return redirect()->route('counties.index')->with('success', 'County created');
    }

    public function edit(County $county)
    {
        return view('counties.edit', compact('county'));
    }

    public function update(Request $request, County $county)
    {
        $request->validate(['county_name' => 'required']);
        $county->update($request->all());
        return redirect()->route('counties.index')->with('success', 'County updated');
    }

    public function destroy(County $county)
    {
        $county->delete();
        return redirect()->route('counties.index')->with('success', 'County deleted');
    }
}
