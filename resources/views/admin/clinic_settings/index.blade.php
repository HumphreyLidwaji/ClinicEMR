@extends('layouts.app')

@section('title', 'System Configuration')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">System Configuration</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label class="form-label">Clinic Name</label>
            <input type="text" name="clinic_name" class="form-control" value="{{ $settings['clinic_name'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="clinic_email" class="form-control" value="{{ $settings['clinic_email'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="clinic_phone" class="form-control" value="{{ $settings['clinic_phone'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="clinic_address" class="form-control" value="{{ $settings['clinic_address'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">MoH Facility Code</label>
            <input type="text" name="moh_code" class="form-control" value="{{ $settings['moh_code'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Hospital Code (e.g. for Employee ID)</label>
            <input type="text" name="hospital_code" class="form-control" value="{{ $settings['hospital_code'] ?? env('HOSPITAL_CODE') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Clinic Logo</label>
            <input type="file" name="clinic_logo" class="form-control">
            @if(!empty($settings['clinic_logo']))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $settings['clinic_logo']) }}" height="60" alt="Logo">
                </div>
            @endif
        </div>

        <button class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
