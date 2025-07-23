@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Create Surgery Request</h5>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0 mt-2">
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

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Submit Request</button>
                    <a href="{{ route('surgery.requests') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
