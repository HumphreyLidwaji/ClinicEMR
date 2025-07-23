@extends('layouts.app')

@section('content')
<div class="container mt-4">
    

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
          <h2 class="mb-0 text-white">Surgery Request Details</h2>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $surgery->patient_name }}</h5>
            <p class="card-text"><strong>Surgery Type:</strong> {{ $surgery->surgery_type }}</p>
            <p class="card-text"><strong>Status:</strong> <span class="text-capitalize">{{ $surgery->status }}</span></p>
            <p class="card-text"><strong>Requested At:</strong> {{ $surgery->created_at->format('Y-m-d H:i') }}</p>
        </div>
       <div class="card-footer">
    <a href="{{ route('surgery.requests') }}" class="btn btn-primary">Back to List</a>
</div>

    </div>

   
</div>
@endsection
