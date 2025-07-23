@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Maternity Cases</h4>
    <a href="{{ route('cases.create') }}" class="btn btn-primary mb-3">New Case</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patient</th>
                <th>LMP</th>
                <th>EDD</th>
                <th>Gravida</th>
                <th>Parity</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $case)
            <tr>
                <td>{{ $case->patient->full_name }}</td>
                <td>{{ $case->lmp }}</td>
                <td>{{ $case->edd }}</td>
                <td>{{ $case->gravida }}</td>
                <td>{{ $case->parity }}</td>
             <td>
    <a href="{{ route('cases.show', $case->id) }}" class="btn btn-sm btn-info">View</a>
    <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-sm btn-warning">Edit</a>

    @foreach($case->babies as $baby)
        @if($baby->patient_id)
            <a href="{{ route('immunizations.index', $baby->patient_id) }}"
               class="btn btn-sm btn-success mt-1">
               💉 Immunization
            </a>
        @endif
    @endforeach
</td>

            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $cases->links() }}
</div>
@endsection
