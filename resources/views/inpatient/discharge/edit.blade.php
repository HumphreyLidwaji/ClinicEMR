@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Discharge Summary</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('discharges.update', $summary->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="discharge_date">Discharge Date</label>
            <input type="date" name="discharge_date" class="form-control"
                value="{{ old('discharge_date', $summary->discharge_date) }}" required>
        </div>

        <div class="mb-3">
            <label for="attending_doctor_id">Attending Doctor</label>
            <select name="attending_doctor_id" class="form-select" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}"
                        {{ $summary->attending_doctor_id == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="icd11_id">ICD-11 Diagnosis</label>
            <select name="icd11_id" class="form-select" required>
                @foreach($icd11s as $icd)
                    <option value="{{ $icd->id }}"
                        {{ $summary->icd11_id == $icd->id ? 'selected' : '' }}>
                        {{ $icd->code }} - {{ $icd->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="summary">Summary</label>
            <textarea name="summary" class="form-control" rows="4" required>{{ old('summary', $summary->summary) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="outcome">Outcome</label>
            <select name="outcome" class="form-select" required>
                <option value="recovered" {{ $summary->outcome == 'recovered' ? 'selected' : '' }}>Recovered</option>
                <option value="referred" {{ $summary->outcome == 'referred' ? 'selected' : '' }}>Referred</option>
                <option value="death" {{ $summary->outcome == 'death' ? 'selected' : '' }}>Death</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="referral_note">Referral Note (if any)</label>
            <textarea name="referral_note" class="form-control" rows="2">{{ old('referral_note', $summary->referral_note) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="death_note">Death Note (if applicable)</label>
            <textarea name="death_note" class="form-control" rows="2">{{ old('death_note', $summary->death_note) }}</textarea>
        </div>

        <button class="btn btn-primary">Update Discharge Summary</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
