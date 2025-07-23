
@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">All Admissions</h4>
            @can('add_admissions')  <a href="{{ route('admissions.create') }}" class="btn btn-light btn-sm">New Admission</a> @endcan
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
                            <th>Patient</th>
                            <th>Visit</th>
                            <th>Status</th>
                            <th>Ward</th>
                            <th>Bed</th>
                            <th>Admission Date</th>
                            <th>Discharge Date</th>
                            <th>Requested By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admissions as $admission)
                        <tr>
                            <td>{{ $admission->id }}</td>
                            <td>{{ $admission->patient->last_name ?? '-' }} {{ $admission->patient->first_name ?? '-' }}</td>
                            <td>{{ $admission->visit_id }}</td>
                            <td>
                                <span class="badge bg-{{ $admission->status == 'pending' ? 'warning' : ($admission->status == 'admitted' ? 'success' : 'secondary') }}">
                                    {{ ucfirst($admission->status) }}
                                </span>
                            </td>
                            <td>{{ $admission->ward->name ?? '-' }}</td>
                            <td>{{ $admission->bed->name ?? '-' }}</td>
                            <td>{{ $admission->admission_date }}</td>
                            <td>{{ $admission->discharge_date }}</td>
                            <td>
                                {{ $admission->requestedBy->name ?? $admission->requested_by ?? '-' }}
                            </td>
                          <td>
    @if($admission->status == 'pending')
        <form action="{{ route('admissions.approve', $admission->id) }}" method="POST" style="display:inline;">
            @csrf
         @can('approve_admissions')<button class="btn btn-sm btn-success mb-1">Approve</button>@endcan
        </form>
    @endif

     @can('assign_bed')<a href="{{ route('admissions.showAssignBed', $admission->id) }}" class="btn btn-sm btn-primary mb-1">Assign Bed</a>@endcan
     @can('bed_transfer')<a href="{{ route('admissions.showTransfer', $admission->id) }}" class="btn btn-warning btn-sm mb-1">Transfer</a>@endcan
     @can('bed_transfer_history')<a href="{{ route('admissions.show', $admission->id) }}" class="btn btn-info btn-sm mb-1">Transfer History</a>@endcan

    {{-- NEW BUTTON FOR CONSULTATION --}}
   @can('inpatient_consultation') <a href="{{ route('inpatient.consultation.create', ['admission_id' => $admission->id]) }}" class="btn btn-secondary btn-sm mb-1">Consult</a>@endcan
</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $admissions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection