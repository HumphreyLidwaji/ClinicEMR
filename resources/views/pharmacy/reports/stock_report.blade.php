@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Stock Report</h4>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Drug</th>
                <th>In Stock</th>
                <th>Reorder Level</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drugs as $drug)
                @php
                    $stock = $drug->stockMovements->sum('quantity');
                @endphp
                <tr>
                    <td>{{ $drug->name }}</td>
                    <td>{{ $stock }}</td>
                    <td>{{ $drug->reorder_level }}</td>
                    <td>
                        @if($stock <= $drug->reorder_level)
                            <span class="badge bg-danger">Low</span>
                        @else
                            <span class="badge bg-success">OK</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
