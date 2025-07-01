@extends('layouts.app')

@section('title', 'Schedule Surgery')

@section('content')
<div class="container">
    <h1 class="mb-4">Schedule Surgery</h1>
    <form action="{{ route('theatre.scheduling.store') }}" method="POST">
        @csrf
        <!-- Patient select, Procedure, Date/Time, Surgeon, OT Room -->
        <div class="form-group">
            <label>Patient</label>
            <select class="form-control" name="patient_id">
                <!-- Patient list -->
            </select>
        </div>
        <div class="form-group">
            <label>Procedure</label>
            <input type="text" name="procedure" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Date & Time</label>
            <input type="datetime-local" name="scheduled_at" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Schedule</button>
    </form>
</div>
@endsection
