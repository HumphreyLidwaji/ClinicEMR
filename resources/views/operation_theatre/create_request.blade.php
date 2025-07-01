@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Surgery Request</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('surgery.requests.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="patient_name" class="form-label">Patient Name</label>
            <input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ old('patient_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="surgery_type" class="form-label">Surgery Type</label>
            <input type="text" name="surgery_type" id="surgery_type" class="form-control" value="{{ old('surgery_type') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Submit Request</button>
        <a href="{{ route('surgery.requests') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection
