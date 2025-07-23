@extends('layouts.app')

@section('title', 'Outpatient Consultation')

@section('content')

<style>
    .form-section-title {
        font-weight: bold;
        color: #0d6efd;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
        border-bottom: 1px solid #e3e3e3;
        padding-bottom: 0.25rem;
    }

</style>

<div class="container-fluid py-4">
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0 text-primary">Patient Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <strong>Name:</strong> {{ $visit->patient->first_name }} {{ $visit->patient->last_name }}
                </div>
                <div class="col-md-4 mb-2">
                    <strong>Gender:</strong> {{ ucfirst($visit->patient->gender) }}
                </div>
                <div class="col-md-4 mb-2">
                    <strong>Age:</strong>
                    {{ \Carbon\Carbon::parse($visit->patient->date_of_birth)->age ?? '-' }} years
                </div>
                <div class="col-md-4 mb-2">
                    <strong>Phone:</strong> {{ $visit->patient->phone ?? '-' }}
                </div>
                <div class="col-md-4 mb-2">
                    <strong>Visit Type:</strong> {{ strtoupper($visit->type) }}
                </div>
                <div class="col-md-4 mb-2">
                    <strong>Visit Date:</strong> {{ $visit->created_at->format('d M Y, H:i') }}
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
            <h1 class="h4 mb-4 text-primary">{{ __('Outpatient Consultation') }}</h1>

            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs mb-4" id="consultationTabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="consultation-tab" data-bs-toggle="tab"
                        href="#consultation" role="tab">Consultation</a></li>
                <li class="nav-item"><a class="nav-link" id="vitals-tab" data-bs-toggle="tab" href="#vitals"
                        role="tab">Vitals</a></li>
                <li class="nav-item"><a class="nav-link" id="medications-tab" data-bs-toggle="tab" href="#medications"
                        role="tab">Medications</a></li>
                <li class="nav-item"><a class="nav-link" id="labs-tab" data-bs-toggle="tab" href="#labs"
                        role="tab">Labs</a></li>
                <li class="nav-item"><a class="nav-link" id="radiology-tab" data-bs-toggle="tab" href="#radiology"
                        role="tab">Radiology</a></li>
                <li class="nav-item"><a class="nav-link" id="services-tab" data-bs-toggle="tab" href="#services"
                        role="tab">Services</a></li>
                <li class="nav-item"><a class="nav-link" id="procedures-tab" data-bs-toggle="tab" href="#procedures"
                        role="tab">Procedures</a></li>
            </ul>

            {{-- Tabs Content --}}
            <div class="tab-content" id="consultationTabsContent">
                {{-- CONSULTATION TAB --}}
                <div class="tab-pane fade show active" id="consultation" role="tabpanel"
                    aria-labelledby="consultation-tab">

                    {{-- Base Consultation ID --}}
                    <input type="hidden" name="visit_id" value="{{ $visit->id }}">
                   

                    {{-- SECTION 1: Note Entry --}}
                    <form method="POST" action="{{ route('consultation.note.store') }}">
                        @csrf
                        <input type="hidden" name="consultation_id" value="{{ $consultation->id ?? '' }}">
                        <input type="hidden" name="visit_id" value="{{ $visit->id ?? '' }}">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Note Type') }}</label>
                                <select name="note_type" class="form-control" required>
                                    <option value="">Select type...</option>
                                    <option value="progress">Progress Note</option>
                                    <option value="history_physical">History & Physical</option>
                                    <option value="consult">Consult Note</option>
                                    <option value="procedure">Procedure Note</option>
                                    <option value="nursing">Nursing Note</option>
                                </select>
                            </div>
                            <div class="col-md-9">
                                <label class="form-label">{{ __('Note Content') }}</label>
                                <textarea name="note" class="form-control" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mb-4">Save Note</button>
                    </form>

                    {{-- SECTION 2: History & Physical --}}
                    <form method="POST" action="{{ route('consultation.history.store') }}">
                        @csrf

                        <input type="hidden" name="visit_id" value="{{ $visit->id ?? '' }}">
                        <div class="form-section-title">Clinical Details</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Past History</label>
                                <textarea name="past_history" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">General Examination</label>
                                <textarea name="general_examination" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Investigation</label>
                                <textarea name="investigation" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mb-4">Save History</button>
                    </form>

                    {{-- SECTION 3: Systematic Examination --}}
                    <form method="POST" action="{{ route('consultation.systematic.store') }}">
                        @csrf
                        <input type="hidden" name="consultation_id" value="{{ $consultation->id ?? '' }}">
                        <input type="hidden" name="visit_id" value="{{ $visit->id ?? '' }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Systematic Examination</label>
                                <select name="systematic_examination_id" class="form-control select2" required>
                                    <option value="">Select finding...</option>
                                    @foreach($systematics as $se)
                                    <option value="{{ $se->id }}">{{ $se->system }} — {{ $se->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mb-4">Save Systematic Exam</button>
                    </form>

                    {{-- SECTION 4: Clinical Diagnosis --}}
                    <form method="POST" action="{{ route('consultation.diagnosis.store') }}">
                        @csrf
                        <input type="hidden" name="consultation_id" value="{{ $consultation->id ?? '' }}">
                        <input type="hidden" name="visit_id" value="{{ $visit->id ?? '' }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Diagnosis</label>
                                <select name="diagnosis_id" class="form-control select2" required>
                                    <option value="">Select clinical diagnosis...</option>
                                    @foreach($diagnoses as $dx)
                                    <option value="{{ $dx->id }}">{{ $dx->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="note">Note (optional):</label>
                                <textarea name="note" class="form-control" rows="2"></textarea>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mb-4">Save Diagnosis</button>
                    </form>

                    {{-- SECTION 5: ICD-11 Diagnosis --}}
                    <form method="POST" action="{{ route('consultation.icd11.store') }}">
                        @csrf
                        <input type="hidden" name="consultation_id" value="{{ $consultation->id ?? '' }}">
                        <input type="hidden" name="visit_id" value="{{ $visit->id ?? '' }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ICD11 Diagnosis</label>
                                <select name="icd11_code_id" class="form-control select2" required>
                                    <option value="">Search ICD11 Diagnosis...</option>
                                    @foreach($icd11s as $icd)
                                    <option value="{{ $icd->id }}">{{ $icd->code }} — {{ $icd->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mb-4">Save ICD11</button>
                    </form>

                    {{-- SECTION 6: Treatment Plan --}}
                    <form method="POST" action="{{ route('consultation.plan.store') }}">
                        @csrf
                        <input type="hidden" name="consultation_id" value="{{ $consultation->id ?? '' }}">
                        <input type="hidden" name="visit_id" value="{{ $visit->id ?? '' }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Treatment Plan</label>
                                <textarea name="treatment_plan" rows="2" class="form-control" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Save Treatment Plan</button>
                    </form>

                </div>

                {{-- VITALS TAB --}}
                {{-- Vitals Tab --}}
                <div class="tab-pane fade" id="vitals" role="tabpanel" aria-labelledby="vitals-tab">

                    <div class="card-box bg-white box-shadow border-radius-10 mt-4">

                        <div class="pd-20">
                            <h1 class="h4 mb-4">{{ __('Vitals Capture') }}</h1>
                            <form method="POST" action="{{ route('visits.vitals.store') }}">
                                @csrf
                                <input type="hidden" name="visit_id" value="{{ $visit->id }}">
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

                                <button class="btn btn-success">{{ __('Save Vitals') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- MEDICATIONS TAB --}}
                <div class="tab-pane fade" id="medications" role="tabpanel" aria-labelledby="medications-tab">
                    <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                        <div class="pd-20">
                            <h1 class="h4 mb-4">{{ __('Prescribe Medications') }}</h1>

                            <form method="POST" action="{{ route('visits.medications.store') }}" id="medication-form">
                                <input type="hidden" name="visit_id" value="{{ $visit->id }}">
                                @csrf

                                <div class="row align-items-end" id="drug-row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Drug</label>
                                        <select id="drug_id" class="form-control select2">
                                            <option value="">Select Drug</option>
                                            @foreach($drugs as $drug)
                                            <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Dosage</label>
                                        <select id="dosage_id" class="form-control select2">
                                            <option value="">Select Dosage</option>
                                            @foreach($dosages as $dosage)
                                            <option value="{{ $dosage->id }}">{{ $dosage->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Route</label>
                                        <select id="route_id" class="form-control select2">
                                            <option value="">Select Route</option>
                                            @foreach($routes as $route)
                                            <option value="{{ $route->id }}">{{ $route->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <label class="form-label">Qty</label>
                                        <input type="number" id="quantity" class="form-control">


                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <label class="form-label">Duration</label>
                                        <input type="number" id="duration" class="form-control">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <button type="button" class="btn btn-secondary btn-sm mt-4"
                                            id="add-drug">Add</button>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <table class="table table-bordered" id="prescription-table">
                                        <thead>
                                            <tr>
                                                <th>Drug</th>
                                                <th>Dosage</th>
                                                <th>Route</th>
                                                <th>Qty</th>
                                                <th>Duration</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>

                                </div>

                                <button class="btn btn-success">{{ __('Save Prescription') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- LABS TAB --}}

                <!-- Labs Tab -->
                <div class="tab-pane fade" id="labs" role="tabpanel" aria-labelledby="labs-tab">
                    <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                        <div class="pd-20">
                            <h1 class="h4 mb-4">{{ __('Order Labs') }}</h1>
                            <form method="POST" action="{{ route('lab-orders.store') }}">
                                @csrf
                           <input type="hidden" name="visit_id" value="{{ $visit->id }}">
                                <input type="hidden" name="billing_type" value="labs">
                                <div class="mb-3">
                                    <label for="labs_services" class="form-label">{{ __('Lab Tests') }}</label>
                                    <select name="services[]" id="labs_services" class="form-select select2" multiple
                                        required>
                                        @foreach($labs as $lab)
                                        <option value="{{ $lab->id }}" data-price="{{ $lab->price }}">
                                            {{ $lab->name }} - ${{ $lab->price }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="total_labs" class="form-label">{{ __('Total Amount') }}</label>
                                    <input type="number" name="total" id="total_labs" class="form-control" readonly
                                        required>
                                </div>
                                <button class="btn btn-success">{{ __('Order') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- RADIOLOGY TAB --}}

                <!-- Radiology Tab -->
                <div class="tab-pane fade" id="radiology" role="tabpanel" aria-labelledby="radiology-tab">
                    <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                        <div class="pd-20">
                            <h1 class="h4 mb-4">{{ __('Order Imaging') }}</h1>
                            <form method="POST" action="{{ route('radiology-orders.store') }}">

                                @csrf
                                <input type="hidden" name="billing_type" value="radiology">
<input type="hidden" name="visit_id" value="{{ $visit->id }}">
                                <div class="mb-3">
                                    <label for="radiology_services"
                                        class="form-label">{{ __('Radiology Services') }}</label>
                                    <select name="services[]" id="radiology_services" class="form-select select2"
                                        multiple required>
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
                                <button class="btn btn-success">{{ __('Order') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- SERVICES TAB --}}
                <!-- Services Tab -->
                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                    <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                        <div class="pd-20">
                            <h1 class="h4 mb-4">{{ __('Bill services') }}</h1>
                            <form method="POST" action="{{ route('service-orders.store') }}">
                                @csrf
                                <input type="hidden" name="billing_type" value="services">

                               <input type="hidden" name="visit_id" value="{{ $visit->id ?? '' }}">
                                <div class="mb-3">
                                    <label for="services_services"
                                        class="form-label">{{ __('Services / Items') }}</label>
                                    <select name="services[]" id="services_services" class="form-select select2"
                                        multiple required>
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
                                <button class="btn btn-success">{{ __('Order') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- PROCEDURES TAB --}}

                <!-- Procedures Tab -->
                <div class="tab-pane fade" id="procedures" role="tabpanel" aria-labelledby="procedures-tab">
                    <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                        <div class="pd-20">
                            <h1 class="h4 mb-4">{{ __('Bill Procedures') }}</h1>
                            <form method="POST" action="{{ route('procedure-orders.store') }}">
                                @csrf
                                <input type="hidden" name="billing_type" value="procedures">
                               <input type="hidden" name="visit_id" value="{{ $visit->id ?? '' }}">
                                <div class="mb-3">
                                    <label for="procedures_services" class="form-label">{{ __('Procedures') }}</label>
                                    <select name="services[]" id="procedures_services" class="form-select select2"
                                        multiple required>
                                        @foreach($procedures as $procedure)
                                        <option value="{{ $procedure->id }}" data-price="{{ $procedure->price }}">
                                            {{ $procedure->name }} - ${{ $procedure->price }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="total_procedures" class="form-label">{{ __('Total Amount') }}</label>
                                    <input type="number" name="total" id="total_procedures" class="form-control"
                                        readonly required>
                                </div>
                                <button class="btn btn-success">{{ __('Order') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')


<script>
    $(document).ready(function () {
        // Initialize select2
        $('.select2').select2({
            placeholder: 'Search...',
            allowClear: true
        });

        // Total calculators
        function calculateTotal(selector, totalId) {
            let total = 0;
            $(selector + ' option:selected').each(function () {
                total += parseFloat($(this).data('price')) || 0;
            });
            $(totalId).val(total.toFixed(2));
        }

        $('#labs_services').change(function () {
            calculateTotal('#labs_services', '#total_labs');
        });

        $('#radiology_services').change(function () {
            calculateTotal('#radiology_services', '#total_radiology');
        });

        $('#services_services').change(function () {
            calculateTotal('#services_services', '#total_services');
        });

        $('#procedures_services').change(function () {
            calculateTotal('#procedures_services', '#total_procedures');
        });

        // Medication add button
        $('#add-drug').click(function () {
            let drug = $('#drug_id option:selected');
            let dosage = $('#dosage_id option:selected');
            let route = $('#route_id option:selected');
            let quantity = $('#quantity').val();
            let duration = $('#duration').val();

            if (!drug.val() || !dosage.val() || !route.val() || !quantity || !duration) {
                alert('Please fill all medication fields.');
                return;
            }

            let row = `
                <tr>
                    <td>
                        <input type="hidden" name="drugs[]" value="${drug.val()}">
                        ${drug.text()}
                    </td>
                    <td>
                        <input type="hidden" name="dosages[]" value="${dosage.val()}">
                        ${dosage.text()}
                    </td>
                    <td>
                        <input type="hidden" name="routes[]" value="${route.val()}">
                        ${route.text()}
                    </td>
                    <td>
                        <input type="hidden" name="quantities[]" value="${quantity}">
                        ${quantity}
                    </td>
                    <td>
                        <input type="hidden" name="durations[]" value="${duration}">
                        ${duration} days
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger remove-row">Remove</button>
                    </td>
                </tr>
            `;

            $('#prescription-table tbody').append(row);

            // Clear inputs
            $('#drug_id').val('').trigger('change');
            $('#dosage_id').val('').trigger('change');
            $('#route_id').val('').trigger('change');
            $('#quantity').val('');
            $('#duration').val('');
        });

        // Remove drug row
        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });
    });

</script>
@endpush
