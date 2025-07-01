
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Profit &amp; Loss Statement</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Income</h5>
                    <ul>
                        @php $totalIncome = 0; @endphp
                        @foreach($incomeAccounts as $account)
                            @php $sum = $account->transactions->where('type', 'credit')->sum('amount'); $totalIncome += $sum; @endphp
                            <li>{{ $account->name }}: {{ number_format($sum, 2) }}</li>
                        @endforeach
                    </ul>
                    <strong>Total Income: {{ number_format($totalIncome, 2) }}</strong>
                </div>
                <div class="col-md-6">
                    <h5>Expenses</h5>
                    <ul>
                        @php $totalExpense = 0; @endphp
                        @foreach($expenseAccounts as $account)
                            @php $sum = $account->transactions->where('type', 'debit')->sum('amount'); $totalExpense += $sum; @endphp
                            <li>{{ $account->name }}: {{ number_format($sum, 2) }}</li>
                        @endforeach
                    </ul>
                    <strong>Total Expenses: {{ number_format($totalExpense, 2) }}</strong>
                </div>
            </div>
            <hr>
            <h5>Net Profit: {{ number_format($totalIncome - $totalExpense, 2) }}</h5>
        </div>
    </div>
</div>
@endsection