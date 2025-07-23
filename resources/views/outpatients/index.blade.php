@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">All Outpatients</h4>
         @can('add_outpatient')    <a href="{{ route('outpatients.create') }}" class="btn btn-light btn-sm">New Registration</a> @endcan
        </div>
        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success m-3">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Visit Date</th>
                            <th>Status</th>
                            <th>Doctor</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($outpatients as $outpatient)
                        <tr>
                            <td>{{ $outpatient->id }}</td>
                            <td>{{ $outpatient->patient->last_name ?? '-' }}</td>
                            <td>{{ $outpatient->visit_date->format('d M Y') ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $outpatient->status == 'pending' ? 'warning' : ($outpatient->status == 'completed' ? 'success' : 'secondary') }}">
                                    {{ ucfirst($outpatient->status) }}
                                </span>
                            </td>
                            <td>{{ $outpatient->doctor->name ?? '-' }}</td>
                        <td>
    @if($outpatient->status == 'pending')
        <form action="{{ route('outpatients.approve', $outpatient->id) }}" method="POST" style="display:inline;">
            @csrf
           @can('approve_outpatient')  <button class="btn btn-sm btn-success mb-1">Approve</button> @endcan
        </form>
    @endif

    <a href="{{ route('outpatients.show', $outpatient->id) }}" class="btn btn-info btn-sm mb-1">View</a>
     @can('edit_outpatient') <a href="{{ route('outpatients.edit', $outpatient->id) }}" class="btn btn-primary btn-sm mb-1">Edit</a>@endcan

    {{-- 🆕 Consult Button --}}
 @can('outpatient_consultation') <a href="{{ route('consultation.create') }}?visit_id={{ $outpatient->visit->id ?? $outpatient->id }}" class="btn btn-secondary btn-sm mb-1">
    Consult
</a> @endcan


</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $outpatients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
