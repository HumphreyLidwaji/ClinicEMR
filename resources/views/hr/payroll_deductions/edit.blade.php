@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Payroll Deduction</h2>

    <form action="{{ route('payroll-deductions.update', $payrollDeduction) }}" method="POST">
        @csrf
        @method('PUT')
        @include('hr.payroll_deductions.form')

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('payroll-deductions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
