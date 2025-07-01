@extends('layouts.app')

@section('title', 'Print Imaging Report')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h4 class="mb-4">{{ __('Print Imaging Report') }}</h4>
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('Report for:') }} John Doe | {{ __('Imaging:') }} X-ray Chest
                </div>
                <div class="card-body">
                    <h5>{{ __('Findings:') }}</h5>
                    <p>Normal appearance of lungs, heart, and mediastinum.</p>

                    <h5>{{ __('Impression:') }}</h5>
                    <p>No signs of active pulmonary disease.</p>

                    <h5>{{ __('Radiologist:') }}</h5>
                    <p>Dr. A. Smith</p>
                </div>
            </div>
            <button class="btn btn-primary mt-3" onclick="window.print()">
                <i class="fas fa-print"></i> {{ __('Print Report') }}
            </button>
        </div>
    </div>
</div>
@endsection