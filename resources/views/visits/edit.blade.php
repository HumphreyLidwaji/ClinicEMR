
@extends('layouts.app')

@section('title', 'Edit Visit')

@section('content')
<div class="container py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h2 class="mb-4">{{ __('Edit Visit') }}</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('visits.update', $visit->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="patient_id" class="form-label">{{ __('Patient') }}</label>
                    <select name="patient_id" class="form-control" required>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $visit->patient_id == $patient->id ? 'selected' : '' }}>
                                {{ $patient->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">{{ __('Visit Type') }}</label>
                    <select name="type" class="form-control" required>
                        <option value="OPD" {{ $visit->type == 'OPD' ? 'selected' : '' }}>{{ __('OPD') }}</option>
                        <option value="IP" {{ $visit->type == 'IP' ? 'selected' : '' }}>{{ __('Inpatient') }}</option>
                        <option value="Emergency" {{ $visit->type == 'Emergency' ? 'selected' : '' }}>{{ __('Emergency') }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="doctor_id" class="form-label">{{ __('Doctor') }}</label>
                    <select name="doctor_id" class="form-control" required>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $visit->doctor_id == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                   <div class="mb-3">
                    <label for="department_id" class="form-label">{{ __('Department') }}</label>
                    <select name="department_id" class="form-control select2" required>
                        <option value="">{{ __('Select Department') }}</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ $visit->department_id == $department->id ? 'selected' : '' }}> {{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $visit->start_date }}" required>
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">{{ __('Is Active') }}</label>
                    <select name="is_active" class="form-control" required>
                        <option value="1" {{ $visit->is_active ? 'selected' : '' }}>{{ __('Active') }}</option>
                        <option value="0" {{ !$visit->is_active ? 'selected' : '' }}>{{ __('Completed') }}</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Update Visit') }}</button>
                <a href="{{ route('visits.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </form>
        </div>
    </div>
</div>
@endsection