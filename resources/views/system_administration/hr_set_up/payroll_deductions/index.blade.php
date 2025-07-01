@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Payroll Deductions</h1>

    <a href="{{ route('payroll-deductions.create') }}" class="btn btn-success mb-3">Add Deduction</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Label</th>
                <th>Type</th>
                <th>Amount/Percentage</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deductions as $deduction)
            <tr>
                <td>{{ $deduction->label }}</td>
                <td>{{ $deduction->type }}</td>
                <td>{{ $deduction->value }}</td>
                <td>
                    <a href="{{ route('payroll-deductions.edit', $deduction->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('payroll-deductions.destroy', $deduction->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this deduction?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
