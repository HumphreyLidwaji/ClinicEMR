@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Pharmacy Alerts</h4>

    <div class="row">
        <div class="col-md-6">
            <h5>🔻 Low Stock</h5>
            <table class="table table-sm">
                <thead><tr><th>Drug</th><th>Stock</th><th>Reorder Level</th></tr></thead>
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
        </div>

        <div class="col-md-6">
            <h5>⏳ Near Expiry (Next 30 Days)</h5>
            <table class="table table-sm">
                <thead><tr><th>Drug</th><th>Batch</th><th>Expires</th></tr></thead>
                <tbody>
                    @foreach($nearExpiry as $batch)
                        <tr>
                            <td>{{ $batch->drug->name }}</td>
                            <td>{{ $batch->batch_number }}</td>
                            <td>{{ $batch->expiry_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
