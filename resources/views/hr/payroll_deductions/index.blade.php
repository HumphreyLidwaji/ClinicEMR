@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Payroll Deductions</h2>

    <a href="{{ route('payroll-deductions.create') }}" class="btn btn-primary mb-3">Add Deduction</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Description</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deductions as $payrollDeduction)
                <tr>
                    <td>{{ $payrollDeduction->name }}</td>
                    <td>${{ number_format($payrollDeduction->amount, 2) }}</td>
                    <td>{{ $payrollDeduction->description }}</td>
                    <td class="text-end">
                        <a href="{{ route('payroll-deductions.edit', $payrollDeduction) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('payroll-deductions.destroy', $payrollDeduction) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this deduction?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
