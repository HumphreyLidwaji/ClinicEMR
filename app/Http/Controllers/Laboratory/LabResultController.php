<?php
namespace App\Http\Controllers\Laboratory;
use App\Http\Controllers\Controller;
use App\Models\LabResult;
use App\Models\LabOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\LabResultTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LabResultController extends Controller
{

  public function index()
{
    $labResults = LabResult::latest()->paginate(10); // Or use all() if pagination not needed
    return view('laboratory.lab_results.index', compact('labResults'));
}


  public function create($orderId)
{
    $order = LabOrder::with('visit.patient')->findOrFail($orderId);
    $templates = LabResultTemplate::all();

    // Decode fields once in PHP
    foreach ($templates as $template) {
    if (is_string($template->fields)) {
        $template->fields = json_decode($template->fields, true);
    }
}


    return view('laboratory.lab_results.create', compact('order', 'templates'));
}


public function store(Request $request)
{
    $data = $request->validate([
        'order_id' => 'required|exists:lab_orders,id',
        'template_id' => 'nullable|exists:lab_result_templates,id',
        'results' => 'required|array',
    ]);

    $processedResults = [];

    foreach ($data['results'] as $field => $item) {
        $value = floatval($item['value'] ?? 0);
        $unit = $item['unit'] ?? null;
        $reference = $item['reference'] ?? null;

        $flag = null;

        // Auto-flag if numeric and reference is parsable
        if ($reference && preg_match('/([\d.]+)\s*-\s*([\d.]+)/', $reference, $matches)) {
            $min = floatval($matches[1]);
            $max = floatval($matches[2]);

            if ($value < $min) {
                $flag = 'Low';
            } elseif ($value > $max) {
                $flag = 'High';
            } else {
                $flag = 'Normal';
            }
        }

        $processedResults[$field] = [
            'value' => $value,
            'unit' => $unit,
            'reference' => $reference,
            'flag' => $flag,
        ];
    }

    LabResult::create([
        'order_id' => $data['order_id'],
        'template_id' => $data['template_id'],
        'results' => $processedResults,
        'resulted_at' => now(),
    ]);

    return redirect()->route('lab_orders.index')->with('success', 'Lab results saved successfully.');
}

public function edit($id)
{
    $result = LabResult::with('order.visit.patient')->findOrFail($id);
    $templates = LabResultTemplate::all();

    // Decode fields once in PHP
    foreach ($templates as $template) {
        if (is_string($template->fields)) {
            $template->fields = json_decode($template->fields, true);
        }
    }

    return view('laboratory.lab_results.edit', compact('result', 'templates'));     
}

public function update(Request $request, $id)
{
    $data = $request->validate([
        'template_id' => 'nullable|exists:lab_result_templates,id',
        'results' => 'required|array',
    ]);

    $result = LabResult::findOrFail($id);
    $processedResults = [];

    foreach ($data['results'] as $field => $item) {
        $value = floatval($item['value'] ?? 0);
        $unit = $item['unit'] ?? null;
        $reference = $item['reference'] ?? null;

        $flag = null;

        // Auto-flag if numeric and reference is parsable
        if ($reference && preg_match('/([\d.]+)\s*-\s*([\d.]+)/', $reference, $matches)) {
            $min = floatval($matches[1]);
            $max = floatval($matches[2]);

            if ($value < $min) {
                $flag = 'Low';
            } elseif ($value > $max) {
                $flag = 'High';
            } else {
                $flag = 'Normal';
            }
        }

        $processedResults[$field] = [
            'value' => $value,
            'unit' => $unit,
            'reference' => $reference,
            'flag' => $flag,
        ];
    }

    // Update the result
    $result->template_id = $data['template_id'];
    $result->results = $processedResults;
    $result->save();

    return redirect()->route('lab_orders.index')->with('success', 'Lab results updated successfully.');
}

public function show($id)
{
    $labResult = LabResult::with('order.visit.patient')->findOrFail($id);

    return view('laboratory.lab_results.show', compact('labResult'));
}







public function exportPdf($id)
{
    $result = LabResult::with('order.visit.patient')->findOrFail($id);

    return Pdf::loadView('laboratory.lab_results.pdf', compact('result'))
        ->download("lab_result_order_{$id}.pdf");
}



}
