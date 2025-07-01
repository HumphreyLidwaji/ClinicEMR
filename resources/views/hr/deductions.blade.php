@extends('layouts.app')
@section('title', 'Deductions')

@section('content')
<div class="container">
    <h4 class="mb-4">Deductions</h4>
    <a href="{{ route('hr.deductions.create') }}" class="btn btn-primary mb-3">Add Deduction</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Reason</th>
                <th>Amount</th>
                <th>Month</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deductions as $deduct)
            <tr>
                <td>{{ $deduct->employee->name }}</td>
                <td>{{ $deduct->reason }}</td>
                <td>{{ number_format($deduct->amount, 2) }}</td>
                <td>{{ $deduct->month }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
