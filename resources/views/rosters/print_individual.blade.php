@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Duty Roster - {{ $employee->first_name }} {{ $employee->last_name }}</h5>
            <button onclick="window.print()" class="btn btn-light btn-sm">Print</button>
        </div>

        <div class="card-body">
            @php
                $daysInMonth = \Carbon\Carbon::now()->daysInMonth;
                $month = \Carbon\Carbon::now()->format('F Y');
            @endphp

            <p><strong>Department:</strong> {{ $employee->department }}</p>
            <p><strong>Month:</strong> {{ $month }}</p>

            <table class="table table-bordered table-sm w-50">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Shift</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = \Carbon\Carbon::createFromDate(null, \Carbon\Carbon::now()->month, $day)->format('Y-m-d');
                            $shift = $rosters->firstWhere('shift_date', $date);
                        @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($date)->format('D, M d') }}</td>
                            <td>{{ $shift->shift ?? '-' }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
