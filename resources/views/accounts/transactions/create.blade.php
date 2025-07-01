
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Add Transaction</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Account</label>
                    <select name="account_id" class="form-select form-control select2" required>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->type }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select form-control" required>
                        <option value="debit">Debit</option>
                        <option value="credit">Credit</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" step="0.01" min="0" required>
                </div>
                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({ width: '100%' });
    });
</script>
@endpush
@endsection