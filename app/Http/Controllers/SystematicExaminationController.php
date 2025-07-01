<?php

namespace App\Http\Controllers;

use App\Models\SystematicExamination;
use Illuminate\Http\Request;

class SystematicExaminationController extends Controller
{
    public function index()
    {
        $items = SystematicExamination::all();
        return view('systematic-examinations.index', compact('items'));
    }

    public function create()
    {
        return view('systematic-examinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'system' => 'required',
        ]);

        SystematicExamination::create($request->all());
        return redirect()->route('systematic-examinations.index')->with('success', 'Added successfully');
    }

    public function edit($id)
    {
        $item = SystematicExamination::findOrFail($id);
        return view('systematic_examinations.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = SystematicExamination::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('systematic-examinations.index')->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        SystematicExamination::destroy($id);
        return redirect()->route('systematic-examinations.index')->with('success', 'Deleted');
    }
}
