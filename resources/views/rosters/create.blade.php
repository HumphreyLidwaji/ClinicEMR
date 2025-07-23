@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text text-white">{{ isset($roster) ? 'Edit Shift' : 'Assign Shift' }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ isset($roster) ? route('rosters.update', $roster) : route('rosters.store') }}" method="POST">
                @csrf
                @if(isset($roster)) @method('PUT') @endif

                <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-control" required>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('employee_id', $roster->employee_id ?? '') == $emp->id ? 'selected' : '' }}>
                                {{ $emp->first_name }} {{ $emp->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="shift_date" class="form-label">Date</label>
                    <input type="date" name="shift_date" id="shift_date" class="form-control" value="{{ old('shift_date', $roster->shift_date ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="shift" class="form-label">Shift</label>
                    <select name="shift" id="shift" class="form-control" required>
                        <option value="Morning" {{ old('shift', $roster->shift ?? '') == 'Morning' ? 'selected' : '' }}>Morning</option>
                        <option value="Evening" {{ old('shift', $roster->shift ?? '') == 'Evening' ? 'selected' : '' }}>Evening</option>
                        <option value="Night" {{ old('shift', $roster->shift ?? '') == 'Night' ? 'selected' : '' }}>Night</option>
                        <option value="Off" {{ old('shift', $roster->shift ?? '') == 'Off' ? 'selected' : '' }}>Off</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($roster) ? 'Update' : 'Assign' }}</button>
                <a href="{{ route('rosters.index') }}" class="btn btn-secondary ms-2">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
