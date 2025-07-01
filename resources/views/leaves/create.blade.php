@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Apply for Leave</h4>

    <form action="{{ route('leaves.store') }}" method="POST">
        @csrf
<p id="balance-info" class="text-info small"></p>

        <div class="mb-3">
            <label>Employee</label>
            <select name="employee_id" class="form-control" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Leave Type</label>
            <input type="text" name="leave_type" class="form-control" required>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Reason</label>
            <textarea name="reason" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-primary">Submit</button>
        <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            width: '100%'
        });

// Optional JS (if you want dynamic balance fetch):
$('select[name="employee_id"]').change(function () {
    var empId = $(this).val();
    var type = $('input[name="leave_type"]').val();
    if (empId && type) {
        $.get(`/leave-balance?employee_id=${empId}&type=${type}`, function (data) {
            $('#balance-info').text(`Remaining Days: ${data.remaining}`);
        });
    }
});

</script>
@endpush




