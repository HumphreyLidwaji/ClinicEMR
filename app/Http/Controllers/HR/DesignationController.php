<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HR\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        return view('hr.designations.index', compact('designations'));
    }

    public function create()
    {
        return view('hr.designations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Designation::create($data);
        return redirect()->route('designations.index');
    }

    public function show(Designation $designation)
    {
        return view('hr.designations.show', compact('designation'));
    }

    public function edit(Designation $designation)
    {
        return view('hr.designations.edit', compact('designation'));
    }

    public function update(Request $request, Designation $designation)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $designation->update($data);
        return redirect()->route('designations.index');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('designations.index');
    }
}
