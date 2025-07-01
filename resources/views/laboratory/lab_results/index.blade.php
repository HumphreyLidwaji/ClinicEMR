@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Laboratory Reports</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Test Count</th>
                <th>Resulted At</th>
                <th>Doctor</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($labResults as $index => $result)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $result->order->visit->patient->full_name ?? 'N/A' }}</td>
                <td>{{ is_array($result->results) ? count($result->results) : count(json_decode($result->results ?? '[]', true)) }}
                </td>

                <td>{{ $result->resulted_at ? \Carbon\Carbon::parse($result->resulted_at)->format('d M Y') : 'Pending' }}
                </td>
                <td>{{ $result->resulted_by ?? 'N/A' }}</td>
                <td>
                    @if($result->resulted_at)
                    <span class="badge bg-success">Completed</span>
                    @else
                    <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('lab_results.show', $result->id) }}" class="btn btn-sm btn-primary">View</a>                                                          
                    <a href="{{ route('lab_results.edit', $result->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="{{ route('lab_results.pdf', $result->id) }}">Export PDF</a>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No lab results found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
