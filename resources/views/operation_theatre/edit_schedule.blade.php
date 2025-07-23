@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Schedule Surgery for {{ $surgery->patient_name }}</h5>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('surgery.schedule.store', $surgery->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="scheduled_date" class="form-label">Scheduled Date</label>
                    <input type="date" name="scheduled_date" id="scheduled_date" class="form-control" value="{{ old('scheduled_date') }}" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Save Schedule</button>
                    <a href="{{ route('surgery.schedule') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
