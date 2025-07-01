
@extends('layouts.app')

@section('title', 'Consultations (OPD Visits)')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">{{ __('Consultations (OPD Visits)') }}</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Patient') }}</th>
                            <th>{{ __('Visit Type') }}</th>
                            <th>{{ __('Consultation Notes') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($consultations as $consultation)
                            <tr>
                                <td>{{ $consultation->visit->patient->first_name ?? '-' }}</td>
                                <td>{{ $consultation->visit->type ?? '-' }}</td>
                                <td>{{ $consultation->notes }}</td>
                                <td>{{ $consultation->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No OPD consultations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $consultations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection