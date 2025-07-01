
@extends('layouts.app')

@section('title', 'Visit Details')

@section('content')
<div class="container py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h2 class="mb-4">{{ __('Visit Details') }}</h2>
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>{{ __('Patient:') }}</strong> {{ $visit->patient->first_name ?? '-' }}</li>
                <li class="list-group-item"><strong>{{ __('Doctor:') }}</strong> {{ $visit->doctor->name ?? '-' }}</li>
                <li class="list-group-item"><strong>{{ __('Visit Type:') }}</strong> {{ $visit->type }}</li>
                <li class="list-group-item"><strong>{{ __('Start Date:') }}</strong> {{ $visit->start_date }}</li>
                <li class="list-group-item"><strong>{{ __('Status:') }}</strong> {{ $visit->is_active ? __('Active') : __('Completed') }}</li>
            </ul>
            <a href="{{ route('visits.index') }}" class="btn btn-secondary">{{ __('Back to Visits') }}</a>
        </div>
    </div>
</div>
@endsection