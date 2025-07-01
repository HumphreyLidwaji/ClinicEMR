<?php

namespace App\Http\Controllers\Laboratory;

use App\Http\Controllers\Controller;
use App\Models\LabResultTemplate;
use Illuminate\Http\Request;

class LabResultTemplateController extends Controller
{
    public function index()
    {
        $templates = LabResultTemplate::latest()->paginate(10);
        return view('laboratory.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('laboratory.templates.create');
    }

  public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'fields' => 'required|array',
        'fields.*.name' => 'required|string',
        'fields.*.unit' => 'nullable|string',
        'fields.*.ref_range' => 'nullable|string|max:255',
        'fields.*.flag' => 'nullable|string|in:Low,Normal,High',
    ]);

    LabResultTemplate::create([
        'name' => $data['name'],
        'fields' => json_encode($data['fields']) // Important: encode if stored in a JSON/text column
    ]);

    return redirect()->route('laboratory.templates.index')->with('success', 'Template created successfully.');
}


public function edit($id)
{
    $template = LabResultTemplate::findOrFail($id);

    // Safely decode if needed
    if (is_string($template->fields)) {
        $template->fields = json_decode($template->fields, true);
    }

    return view('laboratory.templates.edit', compact('template'));
}



  public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'fields' => 'nullable|array',
        'fields.*.name' => 'required|string|max:255',
        'fields.*.unit' => 'nullable|string|max:255',
        'fields.*.ref_range' => 'nullable|string|max:255',
        'fields.*.flag' => 'nullable|string|in:Low,Normal,High',
    ]);

    $template = LabResultTemplate::findOrFail($id);
    $template->name = $validated['name'];
    $template->fields = json_encode($validated['fields']); // Or skip if cast to array
    $template->save();

    return redirect()->route('laboratory.templates.index')->with('success', 'Template updated successfully.');
}


    public function destroy(LabResultTemplate $template)
    {
        $template->delete();
        return redirect()->route('laboratory.templates.index')->with('success', 'Template deleted.');
    }
}
