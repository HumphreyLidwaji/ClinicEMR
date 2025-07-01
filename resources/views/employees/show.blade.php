@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Employee Details</h4>
    <p><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
    <p><strong>Position:</strong> {{ $employee->position }}</p>
    <p><strong>Email:</strong> {{ $employee->email }}</p>
    <p><strong>Phone:</strong> {{ $employee->phone_number }}</p>
    <p><strong>Employee Number:</strong> {{ $employee->employee_number }}</p>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
