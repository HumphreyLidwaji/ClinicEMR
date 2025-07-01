
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>Transfer Patient (Admission #{{ $admission->id }})</h4>
    <form action="{{ route('admissions.transfer', $admission->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ward_id" class="form-label">New Ward</label>
            <select name="ward_id" id="ward_id" class="form-select select2" required>
                <option value="">Select Ward</option>
                @foreach($wards as $ward)
                    <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="bed_id" class="form-label">New Bed</label>
            <select name="bed_id" id="bed_id" class="form-select select2" required>
                <option value="">Select Bed</option>
            </select>
        </div>
        <button class="btn btn-success">Transfer</button>
    </form>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ward_id').select2({ width: '100%', placeholder: 'Select Ward', allowClear: true });
        $('#bed_id').select2({ width: '100%', placeholder: 'Select Bed', allowClear: true });

        $('#ward_id').on('change', function() {
            var wardId = $(this).val();
            $('#bed_id').empty().append('<option value="">Loading...</option>');
            if (wardId) {
                $.ajax({
                    url: '{{ url("inpatient/wards") }}/' + wardId + '/available-beds',
                    type: 'GET',
                    success: function(data) {
                        $('#bed_id').empty().append('<option value="">Select Bed</option>');
                        if (data.length > 0) {
                            $.each(data, function(i, bed) {
                                $('#bed_id').append('<option value="' + bed.id + '">' + bed.name + '</option>');
                            });
                        } else {
                            $('#bed_id').append('<option value="">No available beds</option>');
                        }
                    }
                });
            } else {
                $('#bed_id').empty().append('<option value="">Select Bed</option>');
            }
        });
    });
</script>
@endpush