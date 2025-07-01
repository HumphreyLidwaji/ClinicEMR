
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Select Patient for Sample Collection</h4>
        </div>
        <div class="card-body">
            <form action="" method="GET" onsubmit="location.href=this.action+this.patient.value;return false;">
                <div class="mb-3">
                    <label class="form-label">Patient</label>
                    <select name="patient" class="form-select" required>
                        <option value="">Select Patient</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">
                                {{ $patient->first_name }} {{ $patient->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success" formaction="{{ route('sample-collections.create', '') }}">Proceed</button>
            </form>
        </div>
    </div>
</div>
@endsection