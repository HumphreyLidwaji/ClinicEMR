@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0 text-white">Generate Payslip</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('payslips.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="payroll_id" class="form-label">Payroll Record</label>
                    <select name="payroll_id" id="payroll_id" class="form-select" required>
                        @foreach($payrolls as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->employee->first_name }} - {{ $p->pay_month }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="earnings" class="form-label">Earnings (Optional)</label>
                    <textarea name="earnings[Bonus]" class="form-control" placeholder="Bonus amount"></textarea>
                </div>

                <div class="mb-3">
                    <label for="deductions" class="form-label">Deductions (Optional)</label>
                    <textarea name="deductions[NHIF]" class="form-control" placeholder="NHIF amount"></textarea>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" placeholder="Optional notes or remarks"></textarea>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">Generate Payslip</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
