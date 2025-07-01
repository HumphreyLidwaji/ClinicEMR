@extends('layouts.app)
@section('title', 'Payslips')

@section('content')
<div class="container">
    <h4 class="mb-4">Payslips</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Month</th>
                <th>Net Pay</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payslips as $slip)
            <tr>
                <td>{{ $slip->employee->name }}</td>
                <td>{{ $slip->month }}</td>
                <td>{{ number_format($slip->net, 2) }}</td>
                <td><a href="{{ route('hr.payslips.show', $slip->id) }}" class="btn btn-info btn-sm">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
