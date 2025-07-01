@extends('layouts.app')

@section('title', 'Appointment Queue')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h1 class="h4 mb-4">{{ __('Appointment Queue') }}</h1>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('Patient') }}</th>
                            <th>{{ __('Doctor') }}</th>
                            <th>{{ __('Scheduled Time') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($queue as $item)
                            <tr>
                                <td>{{ $item->patient->name }}</td>
                                <td>{{ $item->doctor->name }}</td>
                                <td>{{ $item->time }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->status == 'Waiting' ? 'warning' : 'success' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->status == 'Waiting')
                                        <form action="{{ route('appointments.start', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button class="btn btn-primary btn-sm">{{ __('Start') }}</button>
                                        </form>
                                    @else
                                        <span class="text-success">{{ __('In Progress') }}</span>
                                    @endif
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