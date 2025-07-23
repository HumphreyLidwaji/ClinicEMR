@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">💡 Pharmacy Alerts</h4>

    <div class="row g-4">
        <!-- Low Stock Section -->
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    🔻 Low Stock
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Drug</th>
                                <th>Stock</th>
                                <th>Reorder Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowStock as $drug)
                                <tr>
                                    <td>{{ $drug->name }}</td>
                                    <td class="text-danger fw-bold">{{ $drug->stock }}</td>
                                    <td>{{ $drug->reorder_level }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">All stocks are sufficient.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Near Expiry Section -->
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    ⏳ Near Expiry (Next 30 Days)
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Drug</th>
                                <th>Batch</th>
                                <th>Expires</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nearExpiry as $batch)
                                <tr>
                                    <td>{{ $batch->drug->name }}</td>
                                    <td>{{ $batch->batch_number }}</td>
                                    <td class="text-warning">{{ \Carbon\Carbon::parse($batch->expiry_date)->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No upcoming expiries.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
