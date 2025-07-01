<?php

namespace App\Http\Controllers\Icd11;

use App\Models\Icd11;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Icd11Controller extends Controller
{
    public function index()
    {
        $icd11s = Icd11::paginate(20);
        return view('icd11.index', compact('icd11s'));
    }

    public function importForm()
    {
        return view('icd11.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new \App\Imports\Icd11Import, $request->file('file'));

        return redirect()->route('icd11.index')->with('success', 'ICD11 codes imported successfully!');
    }
}