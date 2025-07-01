@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Generate Payslip</h4>

    <form action="{{ route('payslips.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Payroll Record</label>
            <select name="payroll_id" class="form-control" required>
                @foreach($payrolls as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->employee->first_name }} - {{ $p->pay_month }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Earnings (Optional)</label>
            <textarea name="earnings[Bonus]" class="form-control" placeholder="Bonus amount"></textarea>
        </div>

        <div class="mb-3">
            <label>Deductions (Optional)</label>
            <textarea name="deductions[NHIF]" class="form-control" placeholder="NHIF amount"></textarea>
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Generate</button>
    </form>
</div>
@endsection
