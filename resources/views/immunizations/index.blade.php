@extends('layouts.app')

@section('content')
<div class="container">
    <h4>🧬 Immunization Schedule for {{ $patient->full_name }}</h4>

    <div class="mb-3">
        <a href="{{ route('immunizations.print', $patient->id) }}" target="_blank" class="btn btn-outline-secondary">🖨️ Print</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Vaccine</th>
                <th>Dose</th>
                <th>Recommended Age (Weeks)</th>
                <th>Given?</th>
                <th>Date Given</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                @php
                    $record = $patient->immunizationRecords->firstWhere('immunization_schedule_id', $schedule->id);
                @endphp
                <tr>
                    <td>{{ $schedule->vaccine_name }}</td>
                    <td>{{ $schedule->dose_label ?? '-' }}</td>
                    <td>{{ $schedule->recommended_age_weeks }} wks</td>
                    <td>{{ $record->is_given ? '✅' : '❌' }}</td>
                    <td>{{ $record->given_date }}</td>
                    <td>{{ $record->remarks }}</td>
                    <td>
                        <form method="POST" action="{{ route('immunizations.update', $record->id) }}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="is_given" value="1">

                            <input type="date" name="given_date" class="form-control form-control-sm mb-1"
                                   value="{{ $record->given_date }}">

                            <input type="text" name="remarks" class="form-control form-control-sm mb-1"
                                   placeholder="Remarks" value="{{ $record->remarks }}">

                            <button class="btn btn-sm btn-success">💾 Save</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
