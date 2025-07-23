@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            Run Payroll
        </div>
        <div class="card-body">
            <form action="{{ route('payrolls.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="pay_month" class="form-label">Payroll Month (YYYY-MM)</label>
                    <input type="month" name="pay_month" id="pay_month" class="form-control" required>
                </div>

                <div class="d-flex justify-content-start gap-2">
                    <button type="submit" class="btn btn-primary">Run Payroll</button>
                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
