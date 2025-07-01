<?php
namespace App\Http\Controllers\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\Ward;

use Illuminate\Http\Request;

class WardController extends Controller
{
    public function index()
    {
        $wards = Ward::withCount('beds')->get();
        return view('inpatient.wards.index', compact('wards'));
    }

    public function create()
    {
        return view('inpatient.wards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:wards,name',
            'description' => 'nullable|string',
        ]);
        Ward::create($request->only('name', 'description'));
        return redirect()->route('wards.index')->with('success', 'Ward created.');
    }

public function availableBeds($wardId)
{
    $beds = \App\Models\Bed::where('ward_id', $wardId)
        ->where('status', 'available')
        ->get(['id', 'name']);
    return response()->json($beds);
}
}