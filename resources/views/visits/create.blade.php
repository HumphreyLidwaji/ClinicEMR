
@extends('layouts.app')

@section('title', 'New Visit')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h1 class="h4 mb-4">{{ __('Start a New Visit') }}</h1>

              {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('visits.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="patient_id" class="form-label">{{ __('Patient') }}</label>
                    <select name="patient_id" class="form-control select2" required>
                        <option value="">{{ __('Select Patient') }}</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->first_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">{{ __('Visit Type') }}</label>
                    <select name="type" class="form-control" required>
                        <option value="OPD">{{ __('OPD') }}</option>
                        <option value="IP">{{ __('Inpatient') }}</option>
                        <option value="Emergency">{{ __('Emergency') }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="doctor_id" class="form-label">{{ __('Doctor') }}</label>
                    <select name="doctor_id" class="form-control select2" required>
                        <option value="">{{ __('Select Doctor') }}</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>

                   <div class="mb-3">
                    <label for="department_id" class="form-label">{{ __('Department') }}</label>
                    <select name="department_id" class="form-control select2" required>
                        <option value="">{{ __('Select Department') }}</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">{{ __('Is Active') }}</label>
                    <select name="is_active" class="form-control" required>
                        <option value="1">{{ __('Active') }}</option>
                        <option value="0">{{ __('Completed') }}</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">{{ __('Start Visit') }}</button>
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