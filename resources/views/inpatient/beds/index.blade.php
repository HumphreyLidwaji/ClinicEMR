
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Beds</h4>
            <a href="{{ route('beds.create') }}" class="btn btn-light btn-sm">Add Bed</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Ward</th>
                            <th>Charge</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beds as $bed)
                        <tr>
                            <td>{{ $bed->name }}</td>
                            <td>{{ $bed->ward->name ?? '-' }}</td>
                            <td>{{ number_format($bed->charge, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $bed->status == 'available' ? 'success' : ($bed->status == 'occupied' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($bed->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection