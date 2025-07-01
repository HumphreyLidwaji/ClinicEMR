@extends('layouts.app')

@section('title', 'Perform Surgery')

@section('content')
<div class="container">
    <h1 class="mb-4">Perform Surgery</h1>
    <!-- Surgery checklist and notes -->
    <form method="POST" action="{{ route('theatre.perform.store') }}">
        @csrf
        <div class="form-group">
            <label>Patient</label>
            <select class="form-control" name="patient_id">
                <!-- Patient list -->
            </select>
        </div>
        <div class="form-group">
            <label>Surgeon</label>
            <input type="text" class="form-control" name="surgeon">
        </div>
        <div class="form-group">
            <label>Notes</label>
            <textarea class="form-control" name="notes" rows="5"></textarea>
        </div>
        <button class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
