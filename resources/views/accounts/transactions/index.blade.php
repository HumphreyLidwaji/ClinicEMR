
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">All Transactions</h4>
            <a href="{{ route('transactions.create') }}" class="btn btn-light btn-sm">Add Transaction</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Account</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $txn)
                        <tr>
                            <td>{{ $txn->date }}</td>
                            <td>{{ $txn->account->name }}</td>
                            <td>{{ $txn->description }}</td>
                            <td>{{ ucfirst($txn->type) }}</td>
                            <td>{{ number_format($txn->amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection