@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Surgery Request Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $surgery->patient_name }}</h5>
            <p class="card-text"><strong>Surgery Type:</strong> {{ $surgery->surgery_type }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($surgery->status) }}</p>
            <p class="card-text"><strong>Requested At:</strong> {{ $surgery->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('surgery.requests') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
