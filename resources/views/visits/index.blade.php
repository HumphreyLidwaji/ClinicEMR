
@extends('layouts.app')

@section('title', 'All Visits')

@section('content')

<div class="container-fluid py-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">{{ __('All Visits') }}</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Patient') }}</th>
                            <th>{{ __('Visit Type') }}</th>
                            <th>{{ __('Doctor') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td>{{ $visit->patient->first_name }}</td>
                                <td>{{ $visit->type }}</td>
                                <td>{{ $visit->doctor->name }}</td>
                                <td>{{ $visit->start_date }}</td>
                                <td>
                                    <span class="badge bg-{{ $visit->is_active ? 'success' : 'secondary' }}">
                                        {{ $visit->is_active ? __('Active') : __('Completed') }}
                                    </span>
                                </td>
                               <td>{{ $visit->department?->name ?? 'N/A' }}</td>

                                <td>
                                    <a href="{{ route('visits.show', $visit->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                    <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                      <a href="{{ route('emr.patient', $visit->patient->id) }}"class="btn btn-sm btn-secondary mb-1">View EMR</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $visits->links() }}
            </div>
        </div>
    </div>
</div>


  

@endsection
@section('scripts')
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
