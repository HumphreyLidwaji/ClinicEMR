@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Duty Roster Calendar</h4>

    {{-- Calendar Controls --}}
    <form method="GET" action="{{ route('rosters.index') }}" class="row g-2 mb-3">
        <div class="col-auto">
            <select name="month" class="form-select" onchange="this.form.submit()">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromDate(null, $m, 1)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-auto">
            <select name="year" class="form-select" onchange="this.form.submit()">
                @for ($y = now()->year - 5; $y <= now()->year + 5; $y++)
                    <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
    </form>

    {{-- Card and Table --}}
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <strong>Shift Assignments - {{ \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth)->format('F Y') }}</strong>
        </div>

        <div class="card-body">
            {{-- Print Buttons --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('rosters.print.department') }}" method="GET" class="d-flex gap-2">
                        <select name="department" class="form-select w-auto" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept }}">{{ $dept }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-primary btn-sm">Print by Department</button>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <form action="{{ route('rosters.print.individual') }}" method="GET" class="d-flex justify-content-end gap-2">
                        <select name="employee_id" class="form-select w-auto" required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-secondary btn-sm">Print Individual</button>
                    </form>
                </div>
            </div>

            <form action="{{ route('rosters.bulkAssign') }}" method="POST">
                @csrf
                <input type="hidden" name="month" value="{{ $selectedMonth }}">
                <input type="hidden" name="year" value="{{ $selectedYear }}">

                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>Employee</th>
                                @php
                                    $daysInMonth = \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth)->daysInMonth;
                                @endphp
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
                                            $date = \Carbon\Carbon::create($selectedYear, $selectedMonth, $day)->format('Y-m-d');
                                            $shift = $rosters->firstWhere(fn($r) => $r->employee_id == $employee->id && $r->shift_date == $date);
                                        @endphp
                                        <td class="text-center">
                                            <select name="assignments[{{ $employee->id }}][{{ $date }}]" class="form-select form-select-sm">
                                                <option value="">--</option>
                                                <option value="Morning" {{ $shift && $shift->shift == 'Morning' ? 'selected' : '' }}>Morning</option>
                                                <option value="Day" {{ $shift && $shift->shift == 'Day' ? 'selected' : '' }}>Day</option>
                                                <option value="Evening" {{ $shift && $shift->shift == 'Evening' ? 'selected' : '' }}>Evening</option>
                                                <option value="Night" {{ $shift && $shift->shift == 'Night' ? 'selected' : '' }}>Night</option>
                                                <option value="Off" {{ $shift && $shift->shift == 'Off' ? 'selected' : '' }}>Off</option>
                                            </select>
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-end bg-light">
                    <button class="btn btn-primary">Save Assignments</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
