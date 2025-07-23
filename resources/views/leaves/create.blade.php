@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            Apply for Leave
        </div>
        <div class="card-body">
            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf
                <p id="balance-info" class="text-info small"></p>

                <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-control select2" required>
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                        @endforeach
                    </select>
                </div>

          <div class="mb-3">
    <label for="leave_type" class="form-label">Leave Type</label>
    <select name="leave_type" id="leave_type" class="form-control select2" required>
        <option value="">-- Select Leave Type --</option>
        <option value="annual" {{ old('leave_type') == 'annual' ? 'selected' : '' }}>Annual</option>
        <option value="sick" {{ old('leave_type') == 'sick' ? 'selected' : '' }}>Sick</option>
        <option value="maternity" {{ old('leave_type') == 'maternity' ? 'selected' : '' }}>Maternity</option>
        <option value="paternity" {{ old('leave_type') == 'paternity' ? 'selected' : '' }}>Paternity</option>
        <option value="unpaid" {{ old('leave_type') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
    </select>
</div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label">Reason</label>
                    <textarea name="reason" id="reason" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            width: '100%'
        });

        // Fetch and show leave balance dynamically when employee or leave type changes
        function fetchBalance() {
            var empId = $('#employee_id').val();
            var leaveType = $('#leave_type').val();
            if (empId && leaveType) {
                $.get(`/leave-balance?employee_id=${empId}&type=${leaveType}`, function (data) {
                    $('#balance-info').text(`Remaining Days: ${data.remaining}`);
                }).fail(function () {
                    $('#balance-info').text('');
                });
            } else {
                $('#balance-info').text('');
            }
        }

        $('#employee_id, #leave_type').on('change keyup', fetchBalance);
    });
</script>
@endpush
