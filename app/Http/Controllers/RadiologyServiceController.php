<?php


namespace App\Http\Controllers;

use App\Models\RadiologyService;
use Illuminate\Http\Request;

class RadiologyServiceController extends Controller
{
    public function index()
    {
        $radiology = RadiologyService::all();
        return view('radiology.index', compact('radiology'));
    }

    public function create()
    {
        return view('radiology.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        RadiologyService::create($request->all());
        return redirect()->route('radiology.index')->with('success', 'Radiology service created.');
    }

    public function edit(RadiologyService $radiology)
    {
        return view('radiology.edit', compact('radiology'));
    }

    public function update(Request $request, RadiologyService $radiology)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        $radiology->update($request->all());
        return redirect()->route('radiology.index')->with('success', 'Radiology service updated.');
    }

    public function destroy(RadiologyService $radiology)
    {
        $radiology->delete();
        return redirect()->route('radiology.index')->with('success', 'Radiology service deleted.');
    }

    public function show(RadiologyService $radiology)
    {
        return view('radiology.show', compact('radiology'));
    }
}