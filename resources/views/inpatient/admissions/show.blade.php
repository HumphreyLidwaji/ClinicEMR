
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0 text-white">Transfer History</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>From Ward</th>
                            <th>From Bed</th>
                            <th>To Ward</th>
                            <th>To Bed</th>
                            <th>By</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admission->transferHistories as $history)
                        <tr>
                            <td>{{ $history->transferred_at }}</td>
                            <td>{{ $history->fromWard->name ?? '-' }}</td>
                            <td>{{ $history->fromBed->name ?? '-' }}</td>
                            <td>{{ $history->toWard->name ?? '-' }}</td>
                            <td>{{ $history->toBed->name ?? '-' }}</td>
                            <td>{{ $history->user->name ?? '-' }}</td>
                            <td>{{ $history->notes }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No transfer history found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection