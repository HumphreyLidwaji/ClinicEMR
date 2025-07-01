@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Discharge Summaries</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Discharge Date</th>
                <th>Doctor</th>
                <th>Diagnosis (ICD-11)</th>
                <th>Outcome</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($summaries as $summary)
                <tr>
                    <td>{{ $loop->iteration + ($summaries->currentPage() - 1) * $summaries->perPage() }}</td>
                    <td>{{ $summary->visit->patient->full_name ?? 'Unknown' }}</td>
                    <td>{{ \Carbon\Carbon::parse($summary->discharge_date)->format('d M Y') }}</td>
                    <td>{{ $summary->doctor->name ?? 'N/A' }}</td>
                    <td>{{ $summary->icd11->code ?? '' }} {{ $summary->icd11->description ?? 'N/A' }}</td>
                    <td>
                        <span class="badge bg-{{ $summary->outcome === 'death' ? 'danger' : ($summary->outcome === 'referred' ? 'warning' : 'success') }}">
                            {{ ucfirst($summary->outcome) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('discharges.edit', $summary->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <a href="{{ route('discharge.show', $summary->id) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No discharge summaries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $summaries->links() }}
</div>
@endsection
