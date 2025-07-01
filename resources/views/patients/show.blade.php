
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card mb-4 shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Patient Information</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>First Name:</strong> {{ $patient->first_name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Last Name:</strong> {{ $patient->last_name }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Date of Birth:</strong> {{ $patient->dob }}
                        </div>
                        <div class="col-md-6">
                            <strong>ID Number:</strong> {{ $patient->id_number }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Gender:</strong> {{ $patient->gender }}
                        </div>
                        <div class="col-md-6">
                            <strong>Phone:</strong> {{ $patient->phone }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Email:</strong> {{ $patient->email }}
                        </div>
                        <div class="col-md-6">
                            <strong>Patient Type:</strong> {{ $patient->patient_type ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow border-0">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Guardian Information</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Name:</strong> {{ $patient->guardian_name ?? '-' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Relationship:</strong> {{ $patient->guardian_relationship ?? '-' }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Phone:</strong> {{ $patient->guardian_phone ?? '-' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Email:</strong> {{ $patient->guardian_email ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection