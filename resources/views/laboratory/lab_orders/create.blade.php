@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Add Lab Order</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('lab_orders.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Visit</label>
                    <select name="visit_id" class="form-select form-control" required>
                        <option value="">Select Visit</option>
                        @foreach($visits as $visit)
                        <option value="{{ $visit->id }}">
                            {{ $visit->id }} - {{ $visit->patient->first_name ?? '' }}
                            {{ $visit->patient->last_name ?? '' }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lab Tests</label>
                    <select name="services[]" class="form-select form-control" multiple required>
                        @foreach($labs as $lab)
                        <option value="{{ $lab->id }}">{{ $lab->name }} ({{ number_format($lab->price,2) }})</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple tests.</small>
                </div>
                <button class="btn btn-success">Save Lab Order</button>
            </form>
        </div>
    </div>
</div>
@endsection
