@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">💊 Dispense Medication — Visit #{{ $visit->id }}</h4>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ $visit->patient->name }} — {{ strtoupper($visit->type) }}
        </div>

        <div class="card-body">
            @php
                $rxList = $visit->prescriptions->where('dispensed', false);
            @endphp

            @if($rxList->count())
                <form action="{{ route('dispense.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="visit_id" value="{{ $visit->id }}">
                    <input type="hidden" name="type" value="{{ strtolower($visit->type) }}">

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Drug</th>
                                    <th>Dosage</th>
                                    <th>Duration</th>
                                    <th>Quantity</th>
                                    <th>Unit Price (KES)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rxList as $i => $rx)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rx->drug->name }}</td>
                                    <td>{{ $rx->dosage->name ?? '—' }}</td>
                                    <td>{{ $rx->duration }}</td>
                                    <td>{{ $rx->quantity }}</td>
                                    <td style="width: 160px;">
                                        <input type="hidden" name="items[{{ $i }}][drug_id]" value="{{ $rx->drug->id }}">
                                        <input type="hidden" name="items[{{ $i }}][quantity]" value="{{ $rx->quantity }}">
                                        <input type="hidden" name="items[{{ $i }}][prescription_id]" value="{{ $rx->id }}">
                                        <input type="number"
                                               name="items[{{ $i }}][price]"
                                               class="form-control form-control-sm"
                                               step="0.01"
                                               required>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="bi bi-check-circle"></i> Confirm Dispense
                        </button>
                    </div>
                </form>
            @else
                <div class="alert alert-info">
                    ✅ All medications have already been dispensed for this visit.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
