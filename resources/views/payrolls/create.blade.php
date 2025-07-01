@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Run Payroll</h4>

    <form action="{{ route('payrolls.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="pay_month">Payroll Month (YYYY-MM)</label>
            <input type="month" name="pay_month" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Run Payroll</button>
        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
