@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Pharmacy Dashboard</h3>

    <div class="row g-4">
        <!-- Total Drugs -->
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h6>Total Drugs</h6>
                    <h3>{{ $drugCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h6>Low Stock Items</h6>
                    <h3>{{ $lowStockCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Today's Sales -->
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h6>Today's Sales</h6>
                    <h3>KES {{ number_format($todaySalesTotal, 2) }}</h3>
                </div>
            </div>
        </div>

        <!-- Expiring Soon -->
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h6>Expiring Soon</h6>
                    <h3>{{ $expiringCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 g-3">
        <div class="col-md-3">
            <a href="{{ route('dispense.index') }}" class="btn btn-outline-primary w-100">Dispense to OPD/IPD</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('sales.create') }}" class="btn btn-outline-success w-100">Direct OTC Sale</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('stock.index') }}" class="btn btn-outline-dark w-100">Stock on Hand</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('pharmacy.reports.sales') }}" class="btn btn-outline-secondary w-100">Sales Report</a>
        </div>
    </div>

    <!-- 🚨 ALERT SECTION BELOW -->
    <div class="row mt-5">
        <!-- Low Stock -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <strong>🔻 Low Stock Alerts</strong>
                </div>
                <div class="card-body p-2">
                    @if($lowStock->count())
                        <table class="table table-sm table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Drug</th>
                                    <th>Stock</th>
                                    <th>Reorder Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStock as $drug)
                                    <tr>
                                        <td>{{ $drug->name }}</td>
                                        <td>{{ $drug->stock }}</td>
                                        <td>{{ $drug->reorder_level }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted mb-0">All stock levels are sufficient.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Expiring Batches -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <strong>⏳ Expiring in Next 30 Days</strong>
                </div>
                <div class="card-body p-2">
                    @if($expiring->count())
                        <table class="table table-sm table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Drug</th>
                                    <th>Batch</th>
                                    <th>Expires</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expiring as $batch)
                                    <tr>
                                        <td>{{ $batch->drug->name }}</td>
                                        <td>{{ $batch->batch_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($batch->expiry_date)->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted mb-0">No near-expiry batches.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
