<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Billing\Invoice;
use App\Models\Sale;
use App\Models\LabOrder;
use App\Models\Admission;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'appointmentsToday' => Appointment::whereDate('created_at', today())->count(),
            'totalPatients'     => Patient::count(),
            'activeVisits'      => Visit::where('is_active', 1)->count(),
            'monthlyRevenue'    => Invoice::whereMonth('created_at', now()->month)->sum('amount'),

            // Extra modules
            'pharmacySales'     => Sale::whereMonth('created_at', now()->month)->sum('total'),
            'labTestsThisMonth' => LabOrder::whereMonth('created_at', now()->month)->count(),
            'inpatients'        => Admission::whereNull('discharge_date')->count(),
        ]);
    }
}
