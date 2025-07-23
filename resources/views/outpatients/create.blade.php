@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">New Outpatient Registration</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('outpatients.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="visit_id" class="form-label">Visit</label>
                    <select name="visit_id" id="visit_id" class="form-control select2" required>
                        <option value="">Select Visit</option>
                        @foreach($visits as $visit)
                        <option value="{{ $visit->id }}">
                            Visit #{{ $visit->id }} - {{ $visit->patient->first_name }}
                            {{ $visit->patient->last_name ?? '' }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="doctor_id" class="form-label">Doctor</label>
                    <select name="doctor_id" id="doctor_id" class="form-control select2" required>
                        <option value="">Select Doctor</option>
                        @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                    @error('doctor_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="visit_date" class="form-label">Visit Date</label>
                    <input type="date" name="visit_date" id="visit_date" class="form-control"
                        value="{{ old('visit_date') }}" required>
                    @error('visit_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                      <!--  <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed-->
                        </option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Register</button>
                <a href="{{ route('outpatients.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
