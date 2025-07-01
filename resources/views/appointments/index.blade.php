@extends('layouts.app')

@section('title', 'All Appointments')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h1 class="h4 mb-4">{{ __('All Appointments') }}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('Patient') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Time') }}</th>
                            <th>{{ __('Doctor') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient?->first_name ?? 'N/A' }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->doctor?->name ?? 'N/A' }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>
                                <a href="{{ route('appointments.edit', $appointment->id) }}"
                                    class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PUT') {{-- or use POST, depending on your route --}}
                                    <button class="btn btn-sm btn-warning"
                                        onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                        {{ __('Cancel') }}
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="mt-3">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
