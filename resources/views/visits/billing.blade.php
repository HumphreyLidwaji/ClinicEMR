@extends('layouts.app')

@section('title', 'Visit Billing')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">{{ __('Visit Billing') }}</h4>
        </div>
        <div class="card-body">
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


            <div class="mb-4">
                <label for="global_visit_id" class="form-label">{{ __('Select Visit') }}</label>
                <select id="global_visit_id" class="form-select select2" required>
                    <option value="">{{ __('Select Visit') }}</option>
                    @foreach($visits as $visit)
                    <option value="{{ $visit->id }}">{{ $visit->patient->first_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs mb-3" id="billingTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="labs-tab" data-bs-toggle="tab" data-bs-target="#labs"
                        type="button" role="tab" aria-controls="labs" aria-selected="true">Labs</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="radiology-tab" data-bs-toggle="tab" data-bs-target="#radiology"
                        type="button" role="tab" aria-controls="radiology" aria-selected="false">Radiology</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#services"
                        type="button" role="tab" aria-controls="services" aria-selected="false">Services</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="procedures-tab" data-bs-toggle="tab" data-bs-target="#procedures"
                        type="button" role="tab" aria-controls="procedures" aria-selected="false">Procedures</button>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="billing-tab" data-bs-toggle="tab" href="#billing" role="tab"
                        aria-controls="billing" aria-selected="false">
                        Billing
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content" id="billingTabsContent">
                <!-- Labs Tab -->
                <div class="tab-pane fade show active" id="labs" role="tabpanel" aria-labelledby="labs-tab">
                    <form method="POST" action="{{ route('lab-orders.store') }}">
                        @csrf
                        <input type="hidden" name="billing_type" value="labs">

                        <input type="hidden" name="visit_id" class="visit-id-input" required>
                        <div class="mb-3">
                            <label for="labs_services" class="form-label">{{ __('Lab Tests') }}</label>
                            <select name="services[]" id="labs_services" class="form-select select2" multiple required>
                                @foreach($labs as $lab)
                                <option value="{{ $lab->id }}" data-price="{{ $lab->price }}">
                                    {{ $lab->name }} - ${{ $lab->price }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_labs" class="form-label">{{ __('Total Amount') }}</label>
                            <input type="number" name="total" id="total_labs" class="form-control" readonly required>
                        </div>
                        <button class="btn btn-primary">{{ __('Generate Invoice') }}</button>
                    </form>
                </div>

                <!-- Radiology Tab -->
                <div class="tab-pane fade" id="radiology" role="tabpanel" aria-labelledby="radiology-tab">
                    <form method="POST" action="{{ route('radiology-orders.store') }}">
                        @csrf
                        <input type="hidden" name="billing_type" value="radiology">

                        <input type="hidden" name="visit_id" class="visit-id-input" required>
                        <div class="mb-3">
                            <label for="radiology_services" class="form-label">{{ __('Radiology Services') }}</label>
                            <select name="services[]" id="radiology_services" class="form-select select2" multiple
                                required>
                                @foreach($radiology as $rad)
                                <option value="{{ $rad->id }}" data-price="{{ $rad->price }}">
                                    {{ $rad->name }} - ${{ $rad->price }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_radiology" class="form-label">{{ __('Total Amount') }}</label>
                            <input type="number" name="total" id="total_radiology" class="form-control" readonly
                                required>
                        </div>
                        <button class="btn btn-primary">{{ __('Generate Invoice') }}</button>
                    </form>
                </div>

                <!-- Services Tab -->
                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                    <form method="POST" action="{{ route('service-orders.store') }}">
                        @csrf
                        <input type="hidden" name="billing_type" value="services">

                        <input type="hidden" name="visit_id" class="visit-id-input" required>
                        <div class="mb-3">
                            <label for="services_services" class="form-label">{{ __('Services / Items') }}</label>
                            <select name="services[]" id="services_services" class="form-select select2" multiple
                                required>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                    {{ $service->name }} - ${{ $service->price }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_services" class="form-label">{{ __('Total Amount') }}</label>
                            <input type="number" name="total" id="total_services" class="form-control" readonly
                                required>
                        </div>
                        <button class="btn btn-primary">{{ __('Generate Invoice') }}</button>
                    </form>
                </div>

                <!-- Procedures Tab -->
                <div class="tab-pane fade" id="procedures" role="tabpanel" aria-labelledby="procedures-tab">
                    <form method="POST" action="{{ route('procedure-orders.store') }}">
                        @csrf
                        <input type="hidden" name="billing_type" value="procedures">
                        <input type="hidden" name="visit_id" class="visit-id-input" required>
                        <div class="mb-3">
                            <label for="procedures_services" class="form-label">{{ __('Procedures') }}</label>
                            <select name="services[]" id="procedures_services" class="form-select select2" multiple
                                required>
                                @foreach($procedures as $procedure)
                                <option value="{{ $procedure->id }}" data-price="{{ $procedure->price }}">
                                    {{ $procedure->name }} - ${{ $procedure->price }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_procedures" class="form-label">{{ __('Total Amount') }}</label>
                            <input type="number" name="total" id="total_procedures" class="form-control" readonly
                                required>
                        </div>
                        <button class="btn btn-primary">{{ __('Generate Invoice') }}</button>
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
    $(document).ready(function () {
        $('.select2').select2({
            width: '100%'
        });

        // Set visit_id in all forms when global select changes
        $('#global_visit_id').on('change', function () {
            var visitId = $(this).val();
            $('.visit-id-input').val(visitId);
        });

        // Optionally, set the initial value if needed
        $('.visit-id-input').val($('#global_visit_id').val());

        // Calculate totals for each tab
        function setupTotalCalc(serviceSelector, totalSelector) {
            $(serviceSelector).on('change', function () {
                let total = 0;
                $(serviceSelector + ' option:selected').each(function () {
                    total += parseFloat($(this).data('price'));
                });
                $(totalSelector).val(total.toFixed(2));
            });
        }

        setupTotalCalc('#labs_services', '#total_labs');
        setupTotalCalc('#radiology_services', '#total_radiology');
        setupTotalCalc('#services_services', '#total_services');
        setupTotalCalc('#procedures_services', '#total_procedures');
    });

</script>
@endpush
