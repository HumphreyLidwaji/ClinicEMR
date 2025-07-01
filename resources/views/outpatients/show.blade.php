@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Outpatient Details</h4>
            <a href="{{ route('outpatients.index') }}" class="btn btn-light btn-sm">Back to List</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $outpatient->id }}</td>
                    </tr>
                    <tr>
                        <th>Patient</th>
                        <td>{{ $outpatient->patient->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Doctor</th>
                        <td>{{ $outpatient->doctor->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Visit Date</th>
                        <td>{{ $outpatient->visit_date->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $outpatient->status == 'pending' ? 'warning' : 'success' }}">
                                {{ ucfirst($outpatient->status) }}
                            </span>
                        </td>
                    </tr>
                    <!-- Add more fields as necessary -->
                </tbody>
            </table>
            <a href="{{ route('outpatients.edit', $outpatient->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
