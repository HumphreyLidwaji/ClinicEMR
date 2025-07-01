 @extends('layouts.app')
@section('title', 'Patient EMR')
@section('content')

<div class="container mt-4">
    <h3 class="mb-4">Patient: {{ $patient->full_name }} ({{ $patient->patient_no }})</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Visit Number</th>
                <th>Visit Type</th>
                <th>Start Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patient->visits as $visit)
            <tr>
                <td>{{ $visit->visit_number }}</td>
                <td>{{ $visit->type }}</td>
                <td>{{ $visit->start_date }}</td>
                <td>{{ $visit->is_active ? 'Active' : 'Completed' }}</td>
                <td>
                    <a href="{{ route('emr.visit', $visit->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('emr.visit.print', $visit->id) }}" class="btn btn-sm btn-secondary" target="_blank">Print</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
