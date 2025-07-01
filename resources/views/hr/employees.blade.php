@extends('layouts.app')
@section('title', 'Employees')

@section('content')
<div class="container">
    <h4 class="mb-4">Employees</h4>
    <a href="{{ route('hr.employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
            <tr>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->position }}</td>
                <td>{{ $emp->department }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
