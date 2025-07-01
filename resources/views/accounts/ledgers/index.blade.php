
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h4>Ledgers</h4>
    @foreach($accounts as $account)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white">
                {{ $account->name }} ({{ ucfirst($account->type) }})
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($account->transactions as $txn)
                            @php $total += $txn->type === 'debit' ? $txn->amount : -$txn->amount; @endphp
                            <tr>
                                <td>{{ $txn->date }}</td>
                                <td>{{ $txn->description }}</td>
                                <td>{{ ucfirst($txn->type) }}</td>
                                <td class="text-end">{{ number_format($txn->amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">Balance</td>
                                <td class="text-end">{{ number_format($total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection