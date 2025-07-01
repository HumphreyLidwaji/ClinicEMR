
@extends('layouts.app')

@section('title', 'Vitals')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h1 class="h4 mb-4">{{ __('Vitals Capture') }}</h1>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('visits.vitals.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="visit_id" class="form-label">{{ __('Visit') }}</label>
                    <select name="visit_id" class="form-control select2" required>
                        <option value="">{{ __('Select Visit') }}</option>
                        @foreach($visits as $visit)
                            <option value="{{ $visit->id }}">{{ $visit->patient->first_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('Blood Pressure') }}</label>
                        <input type="text" name="blood_pressure" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('Pulse') }}</label>
                        <input type="number" name="pulse" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('Temperature') }}</label>
                        <input type="number" step="0.1" name="temperature" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('Weight') }}</label>
                        <input type="number" name="weight" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('Resp') }}</label>
                        <input type="number" name="resp" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('SpO2') }}</label>
                        <input type="number" name="spo2" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('RBS') }}</label>
                        <input type="number" step="0.01" name="rbs" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('FBS') }}</label>
                        <input type="number" step="0.01" name="fbs" class="form-control">
                    </div>
                </div>

                <button class="btn btn-primary">{{ __('Save Vitals') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "{{ __('Select Visit') }}",
            allowClear: true
        });
    });
</script>
@endpush