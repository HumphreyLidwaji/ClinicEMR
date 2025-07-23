@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Duty Roster - Department: {{ $department }}</h5>
            <button onclick="window.print()" class="btn btn-light btn-sm">Print</button>
        </div>

        <div class="card-body">
            @php
                $daysInMonth = \Carbon\Carbon::now()->daysInMonth;
                $month = \Carbon\Carbon::now()->format('F Y');
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Employee</th>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <th>{{ $day }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    @php
                                        $date = \Carbon\Carbon::createFromDate(null, \Carbon\Carbon::now()->month, $day)->format('Y-m-d');
                                        $shift = $rosters->firstWhere(fn($r) => $r->employee_id == $employee->id && $r->shift_date == $date);
                                    @endphp
                                    <td class="text-center">
                                        {{ $shift->shift ?? '-' }}
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /.table-responsive -->
        </div>
    </div>
</div>
@endsection
