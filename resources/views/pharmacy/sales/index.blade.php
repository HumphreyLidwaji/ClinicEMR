@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4"><i class="bi bi-receipt"></i> OTC Sales</h4>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <span class="fw-semibold">Over-the-Counter Sales Records</span>
            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle me-1"></i> New Sale
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Drug</th>
                            <th>Quantity</th>
                            <th>Unit Price (KES)</th>
                            <th>Total (KES)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $sale->drug->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ number_format($sale->price, 2) }}</td>
                                <td>{{ number_format($sale->total, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No sales recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
