@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-4">💊 Dispense Medications to Patients</h4>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs mb-4" id="visitTabs" role="tablist">
        @foreach(['OPD', 'IP', 'Emergency '] as $type)
        <li class="nav-item" role="presentation">
            <button class="nav-link @if($loop->first) active @endif"
                    data-bs-toggle="tab"
                    data-bs-target="#{{ strtolower($type) }}"
                    type="button"
                    role="tab"
                    aria-controls="{{ strtolower($type) }}"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                {{ $type }}
            </button>
        </li>
        @endforeach
    </ul>

    <!-- Tab Panes -->
    <div class="tab-content">
        @foreach(['OPD', 'IP', 'Emergency'] as $type)
        <div class="tab-pane fade @if($loop->first) show active @endif"
             id="{{ strtolower($type) }}"
             role="tabpanel">

            @php
                $filtered = $visits->where('type', $type)->filter(fn($v) => $v->prescriptions->where('dispensed', false)->count());
            @endphp

            @if($filtered->isEmpty())
                <div class="alert alert-info">No pending prescriptions for {{ $type }} visits.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Patient</th>
                                <th>Visit ID</th>
                                <th>Pending</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filtered as $i => $visit)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $visit->patient->name ?? '—' }}</td>
                                <td>{{ $visit->id }}</td>
                                <td>{{ $visit->prescriptions->where('dispensed', false)->count() }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#dispenseModal{{ $visit->id }}">
                                        Dispense
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- ALL Modals Placed Here (OUTSIDE the tables!) -->
    @foreach($visits as $visit)
        @php
            $rxList = $visit->prescriptions->where('dispensed', false);
        @endphp

        @if($rxList->count())
        <div class="modal fade" id="dispenseModal{{ $visit->id }}" tabindex="-1" aria-labelledby="dispenseModalLabel{{ $visit->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="dispenseModalLabel{{ $visit->id }}">
                            Dispense — {{ $visit->patient->name }} (Visit #{{ $visit->id }})
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
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
                                            <th>Qty</th>
                                             <th>To Dispense</th>
                                            <th>Unit Price (KES)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rxList as $k => $rx)
                                        <tr>
                                            <td>{{ $k + 1 }}</td>
                                            <td>{{ $rx->drug->name }}</td>
                                           <td>{{ $rx->dosage->name ?? 'Not found' }}</td>

                                            <td>{{ $rx->duration }}</td>
                                            <td>{{ $rx->quantity }}</td>
                                       <td>
    <input type="number"
           name="items[{{ $k }}][quantity]"
           value="{{ $rx->quantity }}"
           class="form-control form-control-sm"
           min="1"
           required>
</td>
<td>
    <input type="hidden" name="items[{{ $k }}][prescription_id]" value="{{ $rx->id }}">
    <input type="hidden" name="items[{{ $k }}][drug_id]" value="{{ $rx->drug->id }}">

    <input type="number"
           name="items[{{ $k }}][price]"
           step="0.01"
           class="form-control form-control-sm"
           required>
</td>
<td>
    <div class="form-check">
        <input type="checkbox"
               class="form-check-input"
               name="items[{{ $k }}][dispensed]"
               id="dispensedCheck{{ $rx->id }}"
               value="1">
        <label class="form-check-label" for="dispensedCheck{{ $rx->id }}">
            Dispensed
        </label>
    </div>
</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-success btn-sm">
                                    Confirm Dispense
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>
@endsection
