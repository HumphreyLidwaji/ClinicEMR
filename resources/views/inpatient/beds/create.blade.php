@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-success text-white fw-semibold rounded-top-4">
                    Add Bed
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('beds.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Ward</label>
                            <select name="ward_id" class="form-select select2" required>
                                <option value="">Select Ward</option>
                                @foreach($wards as $ward)
                                    <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bed Name/Number</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., Bed A1" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Charge</label>
                            <input type="number" name="charge" class="form-control" step="0.01" min="0" placeholder="e.g., 1500.00" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select select2" required>
                                <option value="">Select Status</option>
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-success px-4">Save Bed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select an option',
            allowClear: true
        });
    });
</script>
@endpush
