@extends('layouts.app')

@section('content')
<div class="container mt-4">


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
               <h2 class="mb-0">Schedule Surgeries</h2>
        </div>
        <div class="card-body p-0">
            @if($surgeries->isEmpty())
                <p class="p-3 mb-0">No pending surgery requests to schedule.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0 align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>Patient</th>
                                <th>Surgery Type</th>
                                <th>Requested At</th>
                                <th class="text-center" style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surgeries as $surgery)
                            <tr>
                                <td>{{ $surgery->patient_name }}</td>
                                <td>{{ $surgery->surgery_type }}</td>
                                <td>{{ $surgery->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('surgery.schedule.edit', $surgery->id) }}" class="btn btn-primary btn-sm">
                                        Schedule
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
