@extends('layouts.app')

@section('title', 'Payroll Report')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Payroll Report</h3>

    <form method="GET" class="row mb-4">
        <div class="col-md-3">
            <label for="month" class="form-label">Month</label>
            <input type="month" name="month" id="month" value="{{ request('month') }}" class="form-control">
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary">Generate</button>
        </div>
    </form>

    @if(isset($salaries))
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Net Salary</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $i => $salary)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $salary->employee->name }}</td>
                <td>{{ number_format($salary->net_amount, 2) }}</td>
                <td>{{ $salary->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p class="text-muted">No payroll data available for this month.</p>
    @endif
</div>
@endsection
