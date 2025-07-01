<?php

namespace App\Http\Controllers\Laboratory;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function labRequests()
    {
        return view('laboratory.lab_requests');
    }

    public function sampleCollection()
    {
        return view('laboratory.sample_collection');
    }

    public function resultsEntry()
    {
        return view('laboratory.results_entry');
    }

    public function printReports()
    {
        return view('laboratory.print_reports');
    }
}
