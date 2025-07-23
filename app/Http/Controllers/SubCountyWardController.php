<?php

namespace App\Http\Controllers;

use App\Models\SubCountyWard;
use App\Models\Subcounty;
use Illuminate\Http\Request;

class SubCountyWardController extends Controller
{
    public function index()
    {
        $wards = SubCountyWard::with('subcounty')->paginate(10);
        return view('sub_county_wards.index', compact('wards'));
    }

    public function create()
    {
        $subcounties = Subcounty::all();
        return view('sub_county_wards.create', compact('subcounties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ward_name' => 'required|string|max:100',
            'subcounty_id' => 'required|exists:subcounties,id',
        ]);

        SubCountyWard::create($request->all());

        return redirect()->route('sub_county_wards.index')->with('success', 'Ward created successfully.');
    }

    public function edit(SubCountyWard $subCountyWard)
    {
        $subcounties = Subcounty::all();
        return view('sub_county_wards.edit', compact('subCountyWard', 'subcounties'));
    }

    public function update(Request $request, SubCountyWard $subCountyWard)
    {
        $request->validate([
            'ward_name' => 'required|string|max:100',
            'subcounty_id' => 'required|exists:subcounties,id',
        ]);

        $subCountyWard->update($request->all());

        return redirect()->route('sub_county_wards.index')->with('success', 'Ward updated successfully.');
    }

    public function destroy(SubCountyWard $subCountyWard)
    {
        $subCountyWard->delete();
        return redirect()->route('sub_county_wards.index')->with('success', 'Ward deleted.');
    }
}

