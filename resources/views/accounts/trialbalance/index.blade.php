
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Trial Balance</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Account</th>
                            <th class="text-end">Debit</th>
                            <th class="text-end">Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalDebit = 0;
                            $totalCredit = 0;
                        @endphp
                        @foreach($accounts as $account)
                        @php
                            $debit = $account->transactions->where('type', 'debit')->sum('amount');
                            $credit = $account->transactions->where('type', 'credit')->sum('amount');
                            $totalDebit += $debit;
                            $totalCredit += $credit;
                        @endphp
                        <tr>
                            <td>{{ $account->name }}</td>
                            <td class="text-end">{{ $debit ? number_format($debit, 2) : '' }}</td>
                            <td class="text-end">{{ $credit ? number_format($credit, 2) : '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td class="text-end">Total</td>
                            <td class="text-end">{{ number_format($totalDebit, 2) }}</td>
                            <td class="text-end">{{ number_format($totalCredit, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection