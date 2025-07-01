@csrf

<div class="row mb-3">
    <div class="col">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name ?? '') }}" required>
    </div>
    <div class="col">
        <label>Middle Name</label>
        <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $employee->middle_name ?? '') }}">
    </div>
    <div class="col">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name ?? '') }}" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <label>Gender</label>
        <select name="gender" class="form-control">
            <option value="">-- Select --</option>
            <option value="male" {{ old('gender', $employee->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $employee->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender', $employee->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>
    <div class="col">
        <label>Date of Birth</label>
        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $employee->date_of_birth ?? '') }}">
    </div>
    <div class="col">
        <label>National ID</label>
        <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $employee->national_id ?? '') }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email ?? '') }}">
    </div>
    <div class="col">
        <label>Phone Number</label>
        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $employee->phone_number ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $employee->address ?? '') }}">
</div>

<div class="row mb-3">
    <div class="col">
        <label>City</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $employee->city ?? '') }}">
    </div>
    <div class="col">
        <label>County</label>
        <input type="text" name="county" class="form-control" value="{{ old('county', $employee->county ?? '') }}">
    </div>
    <div class="col">
        <label>Country</label>
        <input type="text" name="country" class="form-control" value="{{ old('country', $employee->country ?? 'Kenya') }}">
    </div>
</div>

<div class="mb-3">
    <label>Postal Code</label>
    <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $employee->postal_code ?? '') }}">
</div>

<div class="row mb-3">

    <div class="col">
        <label>Hire Date</label>
        <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date', $employee->hire_date ?? '') }}">
    </div>
    <div class="col">
        <label>Contract End Date</label>
        <input type="date" name="contract_end_date" class="form-control" value="{{ old('contract_end_date', $employee->contract_end_date ?? '') }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <label>Department</label>
        <input type="text" name="department" class="form-control" value="{{ old('department', $employee->department ?? '') }}">
    </div>
    <div class="col">
        <label>Position</label>
        <input type="text" name="position" class="form-control" value="{{ old('position', $employee->position ?? '') }}">
    </div>
    <div class="col">
        <label>Employment Type</label>
        <select name="employment_type" class="form-control">
            <option value="permanent" {{ old('employment_type', $employee->employment_type ?? '') == 'permanent' ? 'selected' : '' }}>Permanent</option>
            <option value="contract" {{ old('employment_type', $employee->employment_type ?? '') == 'contract' ? 'selected' : '' }}>Contract</option>
            <option value="intern" {{ old('employment_type', $employee->employment_type ?? '') == 'intern' ? 'selected' : '' }}>Intern</option>
            <option value="casual" {{ old('employment_type', $employee->employment_type ?? '') == 'casual' ? 'selected' : '' }}>Casual</option>
        </select>
    </div>
</div>

<div class="mb-3">
    <label>Basic Salary</label>
    <input type="number" step="0.01" name="basic_salary" class="form-control" value="{{ old('basic_salary', $employee->basic_salary ?? '') }}">
</div>

<div class="row mb-3">
    <div class="col">
        <label>Bank Name</label>
        <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name', $employee->bank_name ?? '') }}">
    </div>
    <div class="col">
        <label>Bank Account</label>
        <input type="text" name="bank_account" class="form-control" value="{{ old('bank_account', $employee->bank_account ?? '') }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <label>NHIF Number</label>
        <input type="text" name="nhif_number" class="form-control" value="{{ old('nhif_number', $employee->nhif_number ?? '') }}">
    </div>
    <div class="col">
        <label>NSSF Number</label>
        <input type="text" name="nssf_number" class="form-control" value="{{ old('nssf_number', $employee->nssf_number ?? '') }}">
    </div>
    <div class="col">
        <label>KRA PIN</label>
        <input type="text" name="kra_pin" class="form-control" value="{{ old('kra_pin', $employee->kra_pin ?? '') }}">
    </div>
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="is_active" class="form-check-input" value="1"
        {{ old('is_active', $employee->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Active</label>
</div>

<button type="submit" class="btn btn-primary">Save</button>
<a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
