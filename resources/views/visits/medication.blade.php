
@extends('layouts.app')

@section('title', 'Medications')

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
            <h1 class="h4 mb-4">{{ __('Prescribe Medications') }}</h1>
            <form method="POST" action="{{ route('visits.medications.store') }}" id="medication-form">
                @csrf
                <div class="mb-3">
                    <label for="visit_id" class="form-label">{{ __('Visit') }}</label>
                    <select name="visit_id" class="form-control select2" required>
                        <option value="">{{ __('Select Visit') }}</option>
                        @foreach($visits as $visit)
                            <option value="{{ $visit->id }}">{{ $visit->patient->first_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row align-items-end" id="drug-row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">{{ __('Drug') }}</label>
                        <select id="drug_id" class="form-control select2">
                            <option value="">{{ __('Select Drug') }}</option>
                            @foreach($drugs as $drug)
                                <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">{{ __('Dosage') }}</label>
                        <select id="dosage_id" class="form-control select2">
                            <option value="">{{ __('Select Dosage') }}</option>
                            @foreach($dosages as $dosage)
                                <option value="{{ $dosage->id }}">{{ $dosage->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ __('Route') }}</label>
                        <select id="route_id" class="form-control select2">
                            <option value="">{{ __('Select Route') }}</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 mb-3">
                        <button type="button" class="btn btn-secondary btn-sm" id="add-drug">{{ __('Add') }}</button>
                    </div>
                </div>

                <div class="mb-3">
                    <table class="table table-bordered" id="prescription-table">
                        <thead>
                            <tr>
                                <th>{{ __('Drug') }}</th>
                                <th>{{ __('Dosage') }}</th>
                                <th>{{ __('Route') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Added drugs will appear here -->
                        </tbody>
                    </table>
                </div>

                <button class="btn btn-success">{{ __('Save Prescription') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "{{ __('Select...') }}",
            allowClear: true
        });

        // Add drug to table
        $('#add-drug').click(function() {
            var drugId = $('#drug_id').val();
            var drugText = $('#drug_id option:selected').text();
            var dosageId = $('#dosage_id').val();
            var dosageText = $('#dosage_id option:selected').text();
            var routeId = $('#route_id').val();
            var routeText = $('#route_id option:selected').text();

            if (!drugId || !dosageId || !routeId) {
                alert("Please select drug, dosage, and route.");
                return;
            }

            // Prevent duplicate drugs (optional)
            var exists = false;
            $('#prescription-table tbody tr').each(function() {
                if ($(this).find('input[name="drug_id[]"]').val() == drugId &&
                    $(this).find('input[name="dosage_id[]"]').val() == dosageId &&
                    $(this).find('input[name="route_id[]"]').val() == routeId) {
                    exists = true;
                }
            });
            if (exists) {
                alert("This drug/dosage/route combination is already added.");
                return;
            }

            var row = `<tr>
                <td>
                    <input type="hidden" name="drug_id[]" value="${drugId}"/>
                    ${drugText}
                </td>
                <td>
                    <input type="hidden" name="dosage_id[]" value="${dosageId}"/>
                    ${dosageText}
                </td>
                <td>
                    <input type="hidden" name="route_id[]" value="${routeId}"/>
                    ${routeText}
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-drug">&times;</button>
                </td>
            </tr>`;
            $('#prescription-table tbody').append(row);

            // Reset selects
            $('#drug_id').val('').trigger('change');
            $('#dosage_id').val('').trigger('change');
            $('#route_id').val('').trigger('change');
        });

        // Remove drug from table
        $(document).on('click', '.remove-drug', function() {
            $(this).closest('tr').remove();
        });

        // Prevent form submit if no drugs added
        $('#medication-form').submit(function() {
            if ($('#prescription-table tbody tr').length === 0) {
                alert("Please add at least one drug.");
                return false;
            }
        });
    });
</script>
@endpush