@extends('layouts.app')

@section('body-class', 'register-page')

@section('content')
<div class="container py-4">
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
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card-box bg-white box-shadow border-radius-10">
                <div class="pd-20">
                    <h2 class="text-center text-primary mb-4">{{ __('Edit Patient') }}</h2>
                    <form method="POST" action="{{ route('patients.update', $patient->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('First Name') }}</label>
                                <input type="text" name="first_name" class="form-control" placeholder="John"
                                    value="{{ old('first_name', $patient->first_name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Last Name') }}</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Doe"
                                    value="{{ old('last_name', $patient->last_name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Date of Birth') }}</label>
                                <input type="date" name="dob" class="form-control"
                                    value="{{ old('dob', $patient->dob) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('ID Number') }}</label>
                                <input type="text" name="id_number" class="form-control" placeholder="Enter ID Number"
                                    value="{{ old('id_number', $patient->id_number) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Gender') }}</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">{{ __('Select') }}</option>
                                    <option value="Male"
                                        {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>
                                        {{ __('Male') }}</option>
                                    <option value="Female"
                                        {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>
                                        {{ __('Female') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Phone Number') }}</label>
                                <input type="text" name="phone" class="form-control" placeholder="+1234567890"
                                    value="{{ old('phone', $patient->phone) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control" placeholder="patient@example.com"
                                    value="{{ old('email', $patient->email) }}">
                            </div>
                        </div>
                        <hr class="my-4">
                        <h5 class="text-primary mb-3">{{ __('Residence Details') }}</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ __('County') }}</label>
                                <select name="county_id" id="county_id" class="form-control" required>
                                    <option value="">{{ __('-- Select County --') }}</option>
                                    @foreach ($counties as $county)
                                    <option value="{{ $county->id }}"
                                        {{ old('county_id', $patient->county_id) == $county->id ? 'selected' : '' }}>
                                        {{ $county->county_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ __('Subcounty') }}</label>
                                <select name="subcounty_id" id="subcounty_id" class="form-control" required>
                                    <option value="">{{ __('-- Select Subcounty --') }}</option>
                                    {{-- 
                Optionally preload subcounties here if you want to show the existing ones before JS loads them 
                or leave blank and load via JS based on county selection.
            --}}
                                    @if(old('county_id', $patient->county_id))
                                    @foreach ($subcounties as $subcounty)
                                    @if ($subcounty->county_id == old('county_id', $patient->county_id))
                                    <option value="{{ $subcounty->id }}"
                                        {{ old('subcounty_id', $patient->subcounty_id) == $subcounty->id ? 'selected' : '' }}>
                                        {{ $subcounty->constituency_name }}
                                    </option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ __('Ward') }}</label>
                                <select name="ward_id" id="ward_id" class="form-control" required>
                                    <option value="">{{ __('-- Select Ward --') }}</option>
                                    {{-- Same as subcounty, preload wards for selected subcounty --}}
                                    @if(old('subcounty_id', $patient->subcounty_id))
                                    @foreach ($wards as $ward)
                                    @if ($ward->subcounty_id == old('subcounty_id', $patient->subcounty_id))
                                    <option value="{{ $ward->id }}"
                                        {{ old('ward_id', $patient->ward_id) == $ward->id ? 'selected' : '' }}>
                                        {{ $ward->ward_name }}
                                    </option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h5 class="text-primary mb-3">{{ __('Guardian Details') }}</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Guardian Name') }}</label>
                                <input type="text" name="guardian_name" class="form-control" placeholder="Guardian Name"
                                    value="{{ old('guardian_name', $patient->guardian_name) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Guardian Relationship') }}</label>
                                <select name="guardian_relationship" class="form-control">
                                    <option value="">{{ __('Select Relationship') }}</option>
                                    <option value="Father"
                                        {{ old('guardian_relationship', $patient->guardian_relationship) == 'Father' ? 'selected' : '' }}>
                                        {{ __('Father') }}</option>
                                    <option value="Mother"
                                        {{ old('guardian_relationship', $patient->guardian_relationship) == 'Mother' ? 'selected' : '' }}>
                                        {{ __('Mother') }}</option>
                                    <option value="Brother"
                                        {{ old('guardian_relationship', $patient->guardian_relationship) == 'Brother' ? 'selected' : '' }}>
                                        {{ __('Brother') }}</option>
                                    <option value="Sister"
                                        {{ old('guardian_relationship', $patient->guardian_relationship) == 'Sister' ? 'selected' : '' }}>
                                        {{ __('Sister') }}</option>
                                    <option value="Uncle"
                                        {{ old('guardian_relationship', $patient->guardian_relationship) == 'Uncle' ? 'selected' : '' }}>
                                        {{ __('Uncle') }}</option>
                                    <option value="Aunt"
                                        {{ old('guardian_relationship', $patient->guardian_relationship) == 'Aunt' ? 'selected' : '' }}>
                                        {{ __('Aunt') }}</option>
                                    <option value="Other"
                                        {{ old('guardian_relationship', $patient->guardian_relationship) == 'Other' ? 'selected' : '' }}>
                                        {{ __('Other') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Guardian Phone') }}</label>
                                <input type="text" name="guardian_phone" class="form-control" placeholder="+1234567890"
                                    value="{{ old('guardian_phone', $patient->guardian_phone) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Guardian Email') }}</label>
                                <input type="email" name="guardian_email" class="form-control"
                                    placeholder="guardian@example.com"
                                    value="{{ old('guardian_email', $patient->guardian_email) }}">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#county_id').on('change', function () {
        let countyId = $(this).val();
        $('#subcounty_id').html('<option value="">Loading...</option>');
        $('#ward_id').html('<option value="">-- Select Ward --</option>');

        if (countyId) {
            $.get('/get-subcounties/' + countyId, function (data) {
                let options = '<option value="">-- Select Subcounty --</option>';
                data.forEach(subcounty => {
                    options +=
                        `<option value="${subcounty.id}">${subcounty.constituency_name}</option>`;
                });
                $('#subcounty_id').html(options);
            });
        } else {
            $('#subcounty_id').html('<option value="">-- Select Subcounty --</option>');
            $('#ward_id').html('<option value="">-- Select Ward --</option>');
        }
    });

    $('#subcounty_id').on('change', function () {
        let subcountyId = $(this).val();
        $('#ward_id').html('<option value="">Loading...</option>');

        if (subcountyId) {
            $.get('/get-wards/' + subcountyId, function (data) {
                let options = '<option value="">-- Select Ward --</option>';
                data.forEach(ward => {
                    options += `<option value="${ward.id}">${ward.ward_name}</option>`;
                });
                $('#ward_id').html(options);
            });
        } else {
            $('#ward_id').html('<option value="">-- Select Ward --</option>');
        }
    });
</script>
@endsection
