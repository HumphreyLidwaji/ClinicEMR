
@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h1 class="h4 mb-4">{{ __('Edit Appointment') }}</h1>
            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="patient_id" class="form-label">{{ __('Patient') }}</label>
                    <select name="patient_id" class="form-control select2" required>
                        <option value="">{{ __('Select Patient') }}</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                                {{ $patient->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="doctor_id" class="form-label">{{ __('Doctor') }}</label>
                    <select name="doctor_id" class="form-control select2" required>
                        <option value="">{{ __('Select Doctor') }}</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">{{ __('Date') }}</label>
                    <input type="date" name="date" class="form-control" value="{{ $appointment->date }}" required>
                </div>

                <div class="mb-3">
                    <label for="time" class="form-label">{{ __('Time') }}</label>
                    <input type="time" name="time" class="form-control" value="{{ $appointment->time }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-control" required>
                        <option value="Scheduled" {{ $appointment->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="No Show" {{ $appointment->status == 'No Show' ? 'selected' : '' }}>No Show</option>
                    </select>
                </div>

                <button class="btn btn-primary">{{ __('Update Appointment') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "{{ __('Select...') }}",
            allowClear: true
        });
    });
</script>
@endpush