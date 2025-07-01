@extends('layouts.app')

@section('body-class', 'patients-page')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
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

    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">{{ __('All Patients') }}</h4>
            <a href="{{ route('patients.create') }}" class="btn btn-light btn-sm">Add Patient</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped  mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('PO NO.') }}</th>
                            <th>{{ __('Full Name') }}</th>
                            <th>{{ __('DOB') }}</th>
                            <th>{{ __('Gender') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('County') }}</th>
                            <th>{{ __('Subcounty') }}</th>
                            <th>{{ __('Ward') }}</th>
                            <th>{{ __('Actions') }}</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>{{ $patient->patient_no }}</td>
                            <td>{{ $patient->first_name }} {{ $patient->last_name }} {{ $patient->middle_name ?? '' }}</td>
                            <td>{{ $patient->dob }}</td>
                            <td>{{ $patient->gender }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->county->county_name ?? '-' }}</td>
                            <td>{{ $patient->subcounty->constituency_name ?? '-' }}</td>
                            <td>{{ $patient->ward->ward_name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-primary mb-1">View</a>
                                <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-secondary mb-1">Edit</a>
                                <a href="{{ route('emr.patient', $patient->id) }}"class="btn btn-sm btn-secondary mb-1">View EMR</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
