@extends('layouts.app')

@section('title', 'Inpatient Management')

@section('content')
<div class="container-fluid py-4">
    {{-- Patient Information Card --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0 text-primary">Patient Information</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Patient:</strong> {{ $admission->patient->first_name }} {{ $admission->patient->last_name }}
                </div>
                <div class="col-md-3">
                    <strong>Gender:</strong> {{ ucfirst($admission->patient->gender) }}
                </div>
                <div class="col-md-3">
                    <strong>Age:</strong> {{ \Carbon\Carbon::parse($admission->patient->date_of_birth)->age ?? '-' }}
                    years
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <strong>Visit Type:</strong> {{ strtoupper($admission->visit->type) }}
                </div>
                <div class="col-md-4">
                    <strong>Visit ID:</strong> {{ $admission->visit_id }}
                </div>
                <div class="col-md-4">
                    <strong>Visit Date:</strong> {{ $admission->visit->created_at->format('d M Y') }}
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
    {{-- Tabs Navigation --}}
    <ul class="nav nav-tabs mb-3" id="inpatientTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="consultation-tab" data-bs-toggle="tab" data-bs-target="#consultation"
                type="button" role="tab" aria-controls="consultation" aria-selected="true">
                {{ __('Consultation') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress" type="button"
                role="tab" aria-controls="progress" aria-selected="false">
                {{ __('Daily Progress') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="nursing-tab" data-bs-toggle="tab" data-bs-target="#nursing" type="button"
                role="tab" aria-controls="nursing" aria-selected="false">
                {{ __('Nursing Notes') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="vitals-tab" data-bs-toggle="tab" data-bs-target="#vitals" type="button"
                role="tab" aria-controls="vitals" aria-selected="false">
                {{ __('Vitals') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="medications-tab" data-bs-toggle="tab" data-bs-target="#medications"
                type="button" role="tab" aria-controls="medications" aria-selected="false">
                {{ __('Medications') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="labs-tab" data-bs-toggle="tab" data-bs-target="#labs" type="button" role="tab"
                aria-controls="labs" aria-selected="false">
                {{ __('Labs') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="radiology-tab" data-bs-toggle="tab" data-bs-target="#radiology" type="button"
                role="tab" aria-controls="radiology" aria-selected="false">
                {{ __('Radiology') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button"
                role="tab" aria-controls="services" aria-selected="false">
                {{ __('Services') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="procedures-tab" data-bs-toggle="tab" data-bs-target="#procedures" type="button"
                role="tab" aria-controls="procedures" aria-selected="false">
                {{ __('Procedures') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="discharge-tab" data-bs-toggle="tab" data-bs-target="#discharge" type="button"
                role="tab" aria-controls="discharge" aria-selected="false">
                {{ __('Discharge') }}
            </button>
        </li>
    </ul>


    {{-- Tabs Content --}}
    <div class="tab-content" id="inpatientTabContent">



        <div class="tab-content" id="inpatientTabsContent">

            {{-- Consultation Tab --}}
            <div class="tab-pane fade show active" id="consultation" role="tabpanel" aria-labelledby="consultation-tab">
                <div class="card-box bg-white box-shadow border-radius-10">
                    <div class="pd-20">
                        <h1 class="h4 mb-4 text-primary">{{ __('Inpatient Consultation') }}</h1>

                        <form method="POST" action="{{ route('inpatient.consultation.store') }}">
                            @csrf
                            <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="consultation_date"
                                        class="form-label">{{ __('Consultation Date') }}</label>
                                    <input type="date" name="consultation_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="notes" class="form-label">{{ __('Consultation Notes') }}</label>
                                    <textarea name="notes" rows="3" class="form-control" required></textarea>
                                </div>
                            </div>

                            <div class="form-section-title">{{ __('Clinical Details') }}</div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="past_history" class="form-label">{{ __('Past History') }}</label>
                                    <textarea name="past_history" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="general_examination"
                                        class="form-label">{{ __('General Examination') }}</label>
                                    <textarea name="general_examination" rows="2" class="form-control"></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="systematic_examination"
                                        class="form-label">{{ __('Systematic Examination') }}</label>
                                    <select name="systematic_examination" class="form-control select2">
                                        <option value="">{{ __('Select Systematic Finding...') }}</option>
                                        @foreach($systematics as $finding)
                                        <option value="{{ $finding->name }}">{{ $finding->system }} —
                                            {{ $finding->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="investigation" class="form-label">{{ __('Investigation') }}</label>
                                    <textarea name="investigation" rows="2" class="form-control"></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="diagnosis" class="form-label">{{ __('Diagnosis') }}</label>
                                    <select name="diagnosis" class="form-control select2">
                                        <option value="">{{ __('Select Clinical Diagnosis...') }}</option>
                                        @foreach($diagnoses as $dx)
                                        <option value="{{ $dx->name }}">{{ $dx->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="icd11_diagnosis" class="form-label">{{ __('ICD11 Diagnosis') }}</label>
                                    <select name="icd11_diagnosis" class="form-control select2" required>
                                        <option value="">{{ __('Search ICD11 Diagnosis...') }}</option>
                                        @foreach($icd11s as $icd)
                                        <option value="{{ $icd->code }} - {{ $icd->description }}">
                                            {{ $icd->code }} - {{ $icd->description }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="treatment_plan" class="form-label">{{ __('Treatment Plan') }}</label>
                                    <textarea name="treatment_plan" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                            <button class="btn btn-success">{{ __('Save Inpatient Consultation') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Daily Progress Tab --}}
            <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                <div class="card-box bg-white box-shadow border-radius-10">
                    <div class="pd-20">
                        <h1 class="h4 mb-4 text-primary">{{ __('Daily Progress Note') }}</h1>

                        <form method="POST" action="{{ route('inpatient.progress.store') }}">

                            @csrf
                            <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="progress_date" class="form-label">{{ __('Date') }}</label>
                                    <input type="date" name="progress_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="subjective" class="form-label">{{ __('Subjective') }}</label>
                                    <textarea name="subjective" rows="2" class="form-control" required></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="objective" class="form-label">{{ __('Objective') }}</label>
                                    <textarea name="objective" rows="2" class="form-control"></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="assessment" class="form-label">{{ __('Assessment') }}</label>
                                    <textarea name="assessment" rows="2" class="form-control" required></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="plan" class="form-label">{{ __('Plan') }}</label>
                                    <textarea name="plan" rows="2" class="form-control" required></textarea>
                                </div>
                            </div>

                            <button class="btn btn-primary">{{ __('Save Progress Note') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Nursing Notes Tab --}}
            <div class="tab-pane fade" id="nursing" role="tabpanel" aria-labelledby="nursing-tab">
                <div class="card-box bg-white box-shadow border-radius-10">
                    <div class="pd-20">
                        <h1 class="h4 mb-4 text-primary">{{ __('Nursing Notes') }}</h1>

                        <form method="POST" action="{{ route('inpatient.nursing.store') }}">
                            @csrf
                            <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nursing_date" class="form-label">{{ __('Date') }}</label>
                                    <input type="date" name="nursing_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="shift" class="form-label">{{ __('Shift') }}</label>
                                    <select name="shift" class="form-control" required>
                                        <option value="">{{ __('Select Shift') }}</option>
                                        <option value="Morning">Morning</option>
                                        <option value="Evening">Evening</option>
                                        <option value="Night">Night</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="observations" class="form-label">{{ __('Observations') }}</label>
                                    <textarea name="observations" rows="2" class="form-control"></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="vitals" class="form-label">{{ __('Vitals') }}</label>
                                    <textarea name="vitals" rows="2" class="form-control"></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="interventions"
                                        class="form-label">{{ __('Interventions / Meds Given') }}</label>
                                    <textarea name="interventions" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                            <button class="btn btn-info">{{ __('Save Nursing Note') }}</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>


        {{-- Vitals Tab --}}
        <div class="tab-pane fade" id="vitals" role="tabpanel" aria-labelledby="vitals-tab">

            <div class="card-box bg-white box-shadow border-radius-10 mt-4">

                <div class="pd-20">
                    <h1 class="h4 mb-4">{{ __('Vitals Capture') }}</h1>


                    <form method="POST" action="{{ route('visits.vitals.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="visit_id" class="form-label">{{ __('Visit') }}</label>
                            <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">
                            <div class="form-control" disabled>
                                {{ $admission->patient->first_name }} {{ $admission->patient->last_name }} (Visit ID:
                                {{ $admission->visit_id }})
                            </div>

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
                        @csrf
                        <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">

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
                                <button type="button" class="btn btn-secondary btn-sm mt-4" id="add-drug">Add</button>
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

                        <button type="submit" class="btn btn-success">{{ __('Save Prescription') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Labs Tab -->
        <div class="tab-pane fade" id="labs" role="tabpanel" aria-labelledby="labs-tab">
            <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                <div class="pd-20">
                    <h1 class="h4 mb-4">{{ __('Order Labs') }}</h1>
                    <form method="POST" action="{{ route('lab-orders.store') }}">
                        @csrf
                        <input type="hidden" name="billing_type" value="labs">

                        <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">
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
                        <button class="btn btn-success">{{ __('Order') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Radiology Tab -->
        <div class="tab-pane fade" id="radiology" role="tabpanel" aria-labelledby="radiology-tab">
            <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                <div class="pd-20">
                    <h1 class="h4 mb-4">{{ __('Order Imaging') }}</h1>
                    <form method="POST" action="{{ route('radiology-orders.store') }}">
                        @csrf
                        <input type="hidden" name="billing_type" value="radiology">

                        <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">
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
                        <button class="btn btn-success">{{ __('Order') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Services Tab -->
        <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
            <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                <div class="pd-20">
                    <h1 class="h4 mb-4">{{ __('Bill services') }}</h1>
                    <form method="POST" action="{{ route('service-orders.store') }}">
                        @csrf
                        <input type="hidden" name="billing_type" value="services">

                        <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">
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
                        <button class="btn btn-success">{{ __('Order') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Procedures Tab -->
        <div class="tab-pane fade" id="procedures" role="tabpanel" aria-labelledby="procedures-tab">
            <div class="card-box bg-white box-shadow border-radius-10 mt-4">
                <div class="pd-20">
                    <h1 class="h4 mb-4">{{ __('Bill Procedures') }}</h1>
                    <form method="POST" action="{{ route('procedure-orders.store') }}">
                        @csrf
                        <input type="hidden" name="billing_type" value="procedures">
                        <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">
                        <div class="mb-3">
                            <label for="procedures_services" class="form-label">{{ __('Procedures') }}</label>
                            <select name="services[]" id="procedures_services" class="form-select select2 form-control"
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
                            <input type="number" name="total" id="total_procedures" class="form-control" readonly
                                required>
                        </div>
                        <button class="btn btn-success">{{ __('Order') }}</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Discharge Tab --}}
        <div class="tab-pane fade" id="discharge" role="tabpanel" aria-labelledby="discharge-tab">
            <div class="card-box bg-white box-shadow border-radius-10 p-3">
                <h5 class="mb-4 text-danger">Discharge Summary</h5>

                <form action="{{ route('discharge.store') }}" method="POST" id="discharge-form">
                    @csrf
                    <input type="hidden" name="visit_id" value="{{ $admission->visit_id }}">

                    {{-- Doctor --}}
                    <div class="mb-3">
                        <label for="attending_doctor_id" class="form-label">Attending Doctor</label>
                        <select name="attending_doctor_id" class="form-select form-control" required>
                            <option value="" disabled selected>-- Select Doctor --</option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Discharge Date --}}
                    <div class="mb-3">
                        <label for="discharge_date" class="form-label">Discharge Date</label>
                        <input type="date" name="discharge_date" class="form-control" value="{{ date('Y-m-d') }}"
                            required>
                    </div>

                    {{-- Summary --}}
                    <div class="mb-3">
                        <label for="summary" class="form-label">Discharge Summary</label>
                        <textarea name="summary" rows="4" class="form-control" required></textarea>
                    </div>

                    {{-- ICD11 --}}
                    <div class="mb-3">
                        <label for="icd11_id" class="form-label">ICD11 Diagnosis</label>
                        <select name="icd11_id" class="form-select form-control" required>
                            <option value="">-- Select Diagnosis --</option>
                            @foreach($icd11s as $icd)
                            <option value="{{ $icd->id }}">{{ $icd->code }} - {{ $icd->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Outcome --}}
                    <div class="mb-3">
                        <label for="outcome" class="form-label">Outcome</label>
                        <select name="outcome" class="form-select form-control" required id="outcome">
                            <option value="" disabled selected>-- Select Outcome --</option>
                            <option value="recovered">Recovered</option>
                            <option value="referred">Referred</option>
                            <option value="death">Death</option>
                        </select>
                    </div>

                    {{-- Referral or Death Details --}}
                    <div class="mb-3" id="referral_details" style="display: none;">
                        <label for="referral_note" class="form-label">Referral Details</label>
                        <textarea name="referral_note" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="mb-3" id="death_details" style="display: none;">
                        <label for="death_note" class="form-label">Cause of Death</label>
                        <textarea name="death_note" rows="3" class="form-control"></textarea>
                    </div>

                    {{-- Discharge Medications --}}
                    <div id="discharge-meds-section" class="border p-3 mt-4">
                        <h6 class="text-primary">Discharge Medications</h6>
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label>Drug</label>
                                <select id="discharge_drug_id" class="form-control">
                                    @foreach($drugs as $drug)
                                    <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Dosage</label>
                                <select id="discharge_dosage_id" class="form-control">
                                    @foreach($dosages as $dosage)
                                    <option value="{{ $dosage->id }}">{{ $dosage->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Route</label>
                                <select id="discharge_route_id" class="form-control">
                                    @foreach($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Duration</label>
                                <input type="number" id="discharge_duration" class="form-control">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Quantity</label>
                                <input type="number" id="discharge_quantity" class="form-control">
                            </div>
                            <div class="col-md-12 mb-2 text-end">
                                <button type="button" id="add-discharge-drug" class="btn btn-outline-secondary btn-sm">+
                                    Add Discharge Drug</button>
                            </div>
                        </div>

                        <table class="table table-bordered" id="discharge-meds-table">
                            <thead>
                                <tr>
                                    <th>Drug</th>
                                    <th>Dosage</th>
                                    <th>Route</th>
                                    <th>Duration</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>


                    <button type="submit" class="btn btn-danger mt-4">Save Discharge Details</button>
                </form>
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
                    <td><input type="hidden" name="drugs[]" value="${drug.val()}">${drug.text()}</td>
                    <td><input type="hidden" name="dosages[]" value="${dosage.val()}">${dosage.text()}</td>
                    <td><input type="hidden" name="routes[]" value="${route.val()}">${route.text()}</td>
                    <td><input type="hidden" name="quantities[]" value="${quantity}">${quantity}</td>
                    <td><input type="hidden" name="durations[]" value="${duration}">${duration} days</td>
                    <td><button type="button" class="btn btn-sm btn-danger remove-row">Remove</button></td>
                </tr>
            `;
            $('#prescription-table tbody').append(row);

            // Reset inputs
            $('#drug_id').val('').trigger('change');
            $('#dosage_id').val('').trigger('change');
            $('#route_id').val('').trigger('change');
            $('#quantity').val('');
            $('#duration').val('');
        });

        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });

        $('#medication-form').submit(function (e) {
            if ($('#prescription-table tbody tr').length === 0) {
                alert('Please add at least one medication before saving.');
                e.preventDefault();
            }
        });

        // Visit ID sync
        $('#global_visit_id').on('change', function () {
            var visitId = $(this).val();
            $('.visit-id-input').val(visitId);
        });
        $('.visit-id-input').val($('#global_visit_id').val());

        // Totals calculation per tab
        function setupTotalCalc(serviceSelector, totalSelector) {
            $(serviceSelector).on('change', function () {
                let total = 0;
                $(serviceSelector + ' option:selected').each(function () {
                    total += parseFloat($(this).data('price')) || 0;
                });
                $(totalSelector).val(total.toFixed(2));
            });
        }
        setupTotalCalc('#labs_services', '#total_labs');
        setupTotalCalc('#radiology_services', '#total_radiology');
        setupTotalCalc('#services_services', '#total_services');
        setupTotalCalc('#procedures_services', '#total_procedures');
    });

    // Outcome section toggle
    document.addEventListener('DOMContentLoaded', function () {
        const outcomeSelect = document.querySelector('[name="outcome"]');
        const referralDetails = document.getElementById('referral_details');
        const deathDetails = document.getElementById('death_details');

        outcomeSelect?.addEventListener('change', function () {
            referralDetails.style.display = this.value === 'referred' ? 'block' : 'none';
            deathDetails.style.display = this.value === 'death' ? 'block' : 'none';
        });
    });

    // Discharge meds
    document.getElementById('add-discharge-drug').addEventListener('click', function () {
        const drugId = document.getElementById('discharge_drug_id').value;
        const drugText = document.getElementById('discharge_drug_id').selectedOptions[0]?.text;
        const dosageId = document.getElementById('discharge_dosage_id').value;
        const dosageText = document.getElementById('discharge_dosage_id').selectedOptions[0]?.text;
        const routeId = document.getElementById('discharge_route_id').value;
        const routeText = document.getElementById('discharge_route_id').selectedOptions[0]?.text;
        const duration = document.getElementById('discharge_duration').value;
        const quantity = document.getElementById('discharge_quantity').value;

        if (!drugId || !dosageId || !routeId || !duration || !quantity) {
            alert('Please fill all discharge drug fields.');
            return;
        }

        const row = `
            <tr>
                <td>${drugText}<input type="hidden" name="drugs[]" value="${drugId}"></td>
                <td>${dosageText}<input type="hidden" name="dosages[]" value="${dosageId}"></td>
                <td>${routeText}<input type="hidden" name="routes[]" value="${routeId}"></td>
                <td>${duration}<input type="hidden" name="durations[]" value="${duration}"></td>
                <td>${quantity}<input type="hidden" name="quantities[]" value="${quantity}"></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-row">X</button></td>
            </tr>
        `;

        document.querySelector('#discharge-meds-table tbody').insertAdjacentHTML('beforeend', row);

        // Clear inputs
        document.getElementById('discharge_drug_id').value = '';
        document.getElementById('discharge_dosage_id').value = '';
        document.getElementById('discharge_route_id').value = '';
        document.getElementById('discharge_duration').value = '';
        document.getElementById('discharge_quantity').value = '';
    });

    // Remove row handler for discharge table
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>



@endpush
