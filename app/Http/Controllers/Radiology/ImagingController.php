<?php

namespace App\Http\Controllers\Radiology;

use App\Http\Controllers\Controller;

class ImagingController extends Controller
{
    public function imagingRequests()
    {
        return view('radiology.imaging_requests');
    }

    public function captureUpload()
    {
        return view('radiology.capture_upload');
    }

    public function radiologistReport()
    {
        return view('radiology.radiologist_report');
    }

    public function printReports()
    {
        return view('radiology.print_reports');
    }
}
