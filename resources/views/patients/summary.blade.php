@extends('layouts.app')

@section('title', 'Patient Summary')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10 mb-4">
        <div class="pd-20">
            <h2 class="h4 mb-3">{{ __('Patient Summary') }}</h2>
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <strong>{{ __('Name:') }}</strong> John Doe
                </div>
                <div class="col-md-6 mb-2">
                    <strong>{{ __('Date of Birth:') }}</strong> 1985-06-20
                </div>
                <div class="col-md-6 mb-2">
                    <strong>{{ __('Gender:') }}</strong> Male
                </div>
                <div class="col-md-6 mb-2">
                    <strong>{{ __('Phone:') }}</strong> +123456789
                </div>
            </div>
            <hr>
            <h3 class="h5 font-weight-bold mb-2">{{ __('Visit History') }}</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Jan 01, 2025 - OPD Visit - Dr. Smith</li>
                <li class="list-group-item">Feb 12, 2025 - Lab Test - CBC</li>
                <li class="list-group-item">Mar 05, 2025 - Radiology - Chest X-Ray</li>
            </ul>
        </div>
    </div>
</div>
@endsection