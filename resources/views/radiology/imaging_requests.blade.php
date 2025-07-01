@extends('layouts.app')

@section('title', 'Imaging Requests')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h4 class="mb-4">{{ __('Imaging Requests') }}</h4>

            <a href="{{ route('radiology.capture_upload') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> {{ __('New Imaging Request') }}
            </a>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('Patient') }}</th>
                            <th>{{ __('Requested By') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Requested At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests ?? [] as $request)
                            <tr>
                                <td>{{ $request->patient_name }}</td>
                                <td>{{ $request->doctor_name }}</td>
                                <td>{{ $request->test_type }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $request->status }}</span>
                                </td>
                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('radiology.capture_upload', ['id' => $request->id]) }}" class="btn btn-sm btn-success">{{ __('Upload') }}</a>
                                    <a href="{{ route('radiology.radiologist_report', ['id' => $request->id]) }}" class="btn btn-sm btn-warning">{{ __('Report') }}</a>
                                    <a href="{{ route('radiology.print_reports', ['id' => $request->id]) }}" class="btn btn-sm btn-secondary">{{ __('Print') }}</a>
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