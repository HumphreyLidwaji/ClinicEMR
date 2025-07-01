<?php
namespace App\Http\Controllers\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Ward;
use Illuminate\Http\Request;

class BedController extends Controller
{
    public function index()
    {
        $beds = Bed::with('ward')->get();
        return view('inpatient.beds.index', compact('beds'));
    }

    public function create()
    {
        $wards = Ward::all();
        return view('inpatient.beds.create', compact('wards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ward_id' => 'required|exists:wards,id',
            'name' => 'required',
            'charge' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied,maintenance',
        ]);
        Bed::create($request->only('ward_id', 'name', 'charge', 'status'));
        return redirect()->route('beds.index')->with('success', 'Bed created.');
    }
}