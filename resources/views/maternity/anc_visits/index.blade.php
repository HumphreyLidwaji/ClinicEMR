@extends('layouts.app')

@section('content')
<div class="container">
    <h4>ANC Visits for {{ $case->patient->full_name }}</h4>

    <a href="{{ route('cases.anc-visits.create', $case->id) }}" class="btn btn-primary mb-3">Add ANC Visit</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Weight</th>
                <th>BP</th>
                <th>FHR</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($case->ancVisits as $visit)
                <tr>
                    <td>{{ $visit->visit_date }}</td>
                    <td>{{ $visit->weight }} kg</td>
                    <td>{{ $visit->bp_systolic }}/{{ $visit->bp_diastolic }}</td>
                    <td>{{ $visit->fetal_heart_rate }}</td>
                    <td>{{ $visit->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
