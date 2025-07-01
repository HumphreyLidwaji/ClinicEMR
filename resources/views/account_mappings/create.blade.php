
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Add Account Mapping</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('account-mappings.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Entity Type</label>
                    <select name="entity_type" class="form-select" id="entity_type_select" required>
                        <option value="">Select Type</option>
                        <option value="lab">Lab</option>
                        <option value="med">Medication</option>
                        <option value="service">Service</option>
                        <option value="procedure">Procedure</option>
                        <option value="imaging">Imaging</option>
                        <option value="item">Item</option>
                        <option value="insurance">Insurance</option>
                        <option value="vendor">Vendor</option>
                        <option value="payroll">Payroll Deduction</option>
                        <option value="department">Department</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Entity</label>
                    <select name="entity_id" class="form-select" id="entity_id_select" required>
                        <option value="">Select entity type first</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Account</label>
                    <select name="account_id" class="form-select" required>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->type }})</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Save Mapping</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // Example: You should implement AJAX endpoints for each entity type
    const endpoints = {
        lab: '{{ url("api/entities/labs") }}',
        med: '{{ url("api/entities/medications") }}',
        service: '{{ url("api/entities/services") }}',
        procedure: '{{ url("api/entities/procedures") }}',
        imaging: '{{ url("api/entities/imagings") }}',
        item: '{{ url("api/entities/items") }}',
        insurance: '{{ url("api/entities/insurances") }}',
        vendor: '{{ url("api/entities/vendors") }}',
        payroll: '{{ url("api/entities/payrolls") }}',
        department: '{{ url("api/entities/departments") }}'
    };

    $('#entity_type_select').on('change', function() {
        let type = $(this).val();
        let $entity = $('#entity_id_select');
        $entity.html('<option value="">Loading...</option>');
        if (endpoints[type]) {
            $.get(endpoints[type], function(data) {
                let options = '<option value="">Select</option>';
                data.forEach(function(item) {
                    options += `<option value="${item.id}">${item.name || item.title || item.id}</option>`;
                });
                $entity.html(options);
            });
        } else {
            $entity.html('<option value="">Select entity type first</option>');
        }
    });
</script>
@endpush
@endsection