@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Schedule Surgeries</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($surgeries->isEmpty())
        <p>No pending surgery requests to schedule.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Surgery Type</th>
                    <th>Requested At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($surgeries as $surgery)
                <tr>
                    <td>{{ $surgery->patient_name }}</td>
                    <td>{{ $surgery->surgery_type }}</td>
                    <td>{{ $surgery->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('surgery.schedule.edit', $surgery->id) }}" class="btn btn-primary btn-sm">Schedule</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
