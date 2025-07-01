<?php

namespace App\Http\Controllers;

use App\Models\Subcounty;
use App\Models\County;
use Illuminate\Http\Request;

class SubcountyController extends Controller
{
    public function index()
    {
      // In your controller method (e.g., index)

$subcounties = Subcounty::with(['county', 'wards'])->get();

return view('subcounties.index', compact('subcounties'));

    }

    public function create()
    {
        $counties = County::all();
        return view('subcounties.create', compact('counties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'county_id' => 'required|exists:counties,id',
            'constituency_name' => 'required',
            'ward' => 'required',
            'alias' => 'required'
        ]);

        Subcounty::create($request->all());
        return redirect()->route('subcounties.index')->with('success', 'Subcounty created');
    }

    public function edit(Subcounty $subcounty)
    {
        $counties = County::all();
        return view('subcounties.edit', compact('subcounty', 'counties'));
    }

    public function update(Request $request, Subcounty $subcounty)
    {
        $request->validate([
            'county_id' => 'required|exists:counties,id',
            'constituency_name' => 'required',
            'ward' => 'required',
            'alias' => 'required'
        ]);

        $subcounty->update($request->all());
        return redirect()->route('subcounties.index')->with('success', 'Subcounty updated');
    }

    public function destroy(Subcounty $subcounty)
    {
        $subcounty->delete();
        return redirect()->route('subcounties.index')->with('success', 'Subcounty deleted');
    }
}
