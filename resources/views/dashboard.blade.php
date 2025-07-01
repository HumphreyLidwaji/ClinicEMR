@extends('layouts.app')

@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0 text-success">ClinicEMR Dashboard</h2>
</div>

<div class="row pb-10">
    <!-- Appointments -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Appointments</span>
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
            <div class="card-body">
               <h4 class="font-weight-bold mb-1">{{ $appointmentsToday }}</h4>
                <p class="mb-0 text-muted">Today</p>
            </div>
        </div>
    </div>

    <!-- Patients -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Patients</span>
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="card-body">
     <h4 class="font-weight-bold mb-1">{{ number_format($totalPatients) }}</h4>
                <p class="mb-0 text-muted">Registered</p>
            </div>
        </div>
    </div>

    <!-- Visits -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Active Visits</span>
                    <i class="fa fa-id-card"></i>
                </div>
            </div>
            <div class="card-body">
              <h4 class="font-weight-bold mb-1">{{ $activeVisits }}</h4>
                <p class="mb-0 text-muted">In Progress</p>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Revenue</span>
                    <i class="fa fa-money"></i>
                </div>
            </div>
            <div class="card-body">
     <h4 class="font-weight-bold mb-1">Ksh {{ number_format($monthlyRevenue) }}</h4>
                <p class="mb-0 text-muted">This Month</p>
            </div>
        </div>
    </div>
</div>

{{-- More Cards: Pharmacy, Lab, Inpatients --}}
<div class="row pb-10">
    <div class="col-md-4 mb-20">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <span>Pharmacy Sales</span>
            </div>
            <div class="card-body">
             <h4 class="font-weight-bold">{{ 'Ksh ' . number_format($pharmacySales) }}</h4>
                <p class="text-muted mb-0">This Month</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-20">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <span>Lab Tests</span>
            </div>
            <div class="card-body">
       <h4 class="font-weight-bold">{{ $labTestsThisMonth }}</h4>
                <p class="text-muted mb-0">Performed This Month</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-20">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <span>Inpatients</span>
            </div>
            <div class="card-body">
               <h4 class="font-weight-bold">{{ $inpatients }} Admitted</h4>
                <p class="text-muted mb-0">Currently in Wards</p>
            </div>
        </div>
    </div>
</div>
@endsection


