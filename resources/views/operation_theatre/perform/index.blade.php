@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Perform Scheduled Surgeries</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($surgeries as $surgery)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $surgery->patient_name }} - {{ $surgery->surgery_type }}</h5>
                <p><strong>Scheduled At:</strong> {{ \Carbon\Carbon::parse($surgery->scheduled_at)->format('d M Y, H:i') }}</p>

                <form action="{{ route('surgery.perform.store', $surgery->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="notes-{{ $surgery->id }}" class="form-label">Surgery Notes (optional)</label>
                        <textarea name="notes" id="notes-{{ $surgery->id }}" class="form-control" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Mark as Performed</button>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-info">No surgeries are currently scheduled.</div>
    @endforelse
</div>
@endsection
