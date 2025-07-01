@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">New Outpatient Registration</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('outpatients.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient</label>
                    <select name="patient_id" id="patient_id" class="form-select" required>
                        <option value="">Select Patient</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="doctor_id" class="form-label">Doctor</label>
                    <select name="doctor_id" id="doctor_id" class="form-select" required>
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
                    <input type="date" name="visit_date" id="visit_date" class="form-control" value="{{ old('visit_date') }}" required>
                    @error('visit_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                <a href="{{ route('outpatients.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
