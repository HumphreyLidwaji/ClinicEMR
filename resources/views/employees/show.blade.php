@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            Employee Details
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <strong>Name:</strong><br>
                    {{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Gender:</strong><br>
                    {{ ucfirst($employee->gender) }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Date of Birth:</strong><br>
                    {{ $employee->date_of_birth }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <strong>National ID:</strong><br>
                    {{ $employee->national_id }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Email:</strong><br>
                    {{ $employee->email }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Phone Number:</strong><br>
                    {{ $employee->phone_number }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Address:</strong><br>
                {{ $employee->address }}, {{ $employee->city }}, {{ $employee->county }}, {{ $employee->country }} - {{ $employee->postal_code }}
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <strong>Hire Date:</strong><br>
                    {{ $employee->hire_date }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Contract End Date:</strong><br>
                    {{ $employee->contract_end_date }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Employment Type:</strong><br>
                    {{ ucfirst($employee->employment_type) }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <strong>Department:</strong><br>
                    {{ $employee->department }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Position:</strong><br>
                    {{ $employee->position }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Basic Salary:</strong><br>
                    KES {{ number_format($employee->basic_salary, 2) }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <strong>Bank Name:</strong><br>
                    {{ $employee->bank_name }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Bank Account:</strong><br>
                    {{ $employee->bank_account }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Employee Number:</strong><br>
                    {{ $employee->employee_number }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <strong>NHIF Number:</strong><br>
                    {{ $employee->nhif_number }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>NSSF Number:</strong><br>
                    {{ $employee->nssf_number }}
                </div>
                <div class="col-md-4 mb-3">
                    <strong>KRA PIN:</strong><br>
                    {{ $employee->kra_pin }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Status:</strong><br>
                @if($employee->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </div>

            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
