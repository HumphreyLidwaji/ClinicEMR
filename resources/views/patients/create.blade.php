@extends('layouts.app')

@section('body-class', 'register-page')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
    <div class="col-12">

            <div class="card-box bg-white box-shadow border-radius-10">
                <div class="pd-20">
                    <h2 class="text-center text-primary mb-4">{{ __('Register New Patient') }}</h2>
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
                    <form method="POST" action="{{ route('patients.store') }}">
                        @csrf
                        <h5 class="text-primary mb-3">{{ __('Personal Details') }}</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('First Name') }}</label>
                                <input type="text" name="first_name" class="form-control" placeholder="John" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Last Name') }}</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Doe" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Date of Birth') }}</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('ID Number') }}</label>
                                <input type="text" name="id_number" class="form-control" placeholder="Enter ID Number">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Gender') }}</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">{{ __('Select') }}</option>
                                    <option value="Male">{{ __('Male') }}</option>
                                    <option value="Female">{{ __('Female') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Phone Number') }}</label>
                                <input type="text" name="phone" class="form-control" placeholder="+1234567890">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control" placeholder="patient@example.com">
                            </div>
                        </div>
                        <hr class="my-4">
                        <h5 class="text-primary mb-3">{{ __('Residence Details') }}</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ __('County') }}</label>
                                <select name="county_id" id="county_id" class="form-control" required>
                                    <option value="">-- Select County --</option>
                                    @foreach ($counties as $county)
                                    <option value="{{ $county->id }}">{{ $county->county_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ __('Subcounty') }}</label>
                                <select name="subcounty_id" id="subcounty_id" class="form-control" required>
                                    <option value="">-- Select Subcounty --</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ __('Ward') }}</label>
                                <select name="ward_id" id="ward_id" class="form-control" required>
                                    <option value="">-- Select Ward --</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="text-primary mb-3">{{ __('Guardian Details') }}</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Guardian Name') }}</label>
                                <input type="text" name="guardian_name" class="form-control"
                                    placeholder="Guardian Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Guardian Relationship') }}</label>
                                <select name="guardian_relationship" class="form-control">
                                    <option value="">{{ __('Select Relationship') }}</option>
                                    <option value="Father">{{ __('Father') }}</option>
                                    <option value="Mother">{{ __('Mother') }}</option>
                                    <option value="Brother">{{ __('Brother') }}</option>
                                    <option value="Sister">{{ __('Sister') }}</option>
                                    <option value="Uncle">{{ __('Uncle') }}</option>
                                    <option value="Aunt">{{ __('Aunt') }}</option>
                                    <option value="Other">{{ __('Other') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Guardian Phone') }}</label>
                                <input type="text" name="guardian_phone" class="form-control" placeholder="+1234567890">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Guardian Email') }}</label>
                                <input type="email" name="guardian_email" class="form-control"
                                    placeholder="guardian@example.com">
                            </div>
                        </div>
                        <div class="mt-3">
                            @can('createpatients')
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>
                            @endcan
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
        }
    });

</script>

@endsection
