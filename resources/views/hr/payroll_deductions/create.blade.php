@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Payroll Deduction</h2>

    <form action="{{ route('payroll-deductions.store') }}" method="POST">
        @csrf
        @include('hr.payroll_deductions.form')

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('payroll-deductions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
