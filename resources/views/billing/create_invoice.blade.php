@extends('layouts.app')

@section('title', 'Create Invoice')

@section('content')
<div class="container-fluid py-4">
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
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h4 class="mb-4">{{ __('Create Invoice') }}</h4>
            <form action="{{ route('billing.invoices.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Patient Name') }}</label>
                    <input type="text" name="patient_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Visit Type') }}</label>
                    <select name="visit_type" class="form-control" required>
                        <option value="OPD">{{ __('OPD') }}</option>
                        <option value="IP">{{ __('IP') }}</option>
                        <option value="Emergency">{{ __('Emergency') }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Total Amount') }}</label>
                    <input type="number" name="amount" step="0.01" class="form-control" required>
                </div>

                <button class="btn btn-success">{{ __('Save Invoice') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection