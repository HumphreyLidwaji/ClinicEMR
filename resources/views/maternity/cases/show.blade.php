@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Maternity Case: {{ $case->patient->full_name }}</h4>

    <ul class="nav nav-tabs mt-4" id="maternityTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab">Overview</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="anc-tab" data-bs-toggle="tab" href="#anc" role="tab">ANC Visits</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="delivery-tab" data-bs-toggle="tab" href="#delivery" role="tab">Delivery</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="babies-tab" data-bs-toggle="tab" href="#babies" role="tab">Babies</a>
        </li>
    </ul>

    <div class="tab-content border border-top-0 p-3" id="maternityTabContent">
        <!-- Overview Tab -->
        <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <table class="table table-sm">
                <tr>
                    <th>Patient</th>
                    <td>{{ $case->patient->full_name }}</td>
                </tr>
                <tr>
                    <th>LMP</th>
                    <td>{{ $case->lmp }}</td>
                </tr>
                <tr>
                    <th>EDD</th>
                    <td>{{ $case->edd }}</td>
                </tr>
                <tr>
                    <th>Gravida</th>
                    <td>{{ $case->gravida }}</td>
                </tr>
                <tr>
                    <th>Parity</th>
                    <td>{{ $case->parity }}</td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td>{{ $case->notes }}</td>
                </tr>
            </table>
            <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-warning">Edit Case</a>
            <a href="{{ route('cases.print', $case->id) }}" target="_blank" class="btn btn-outline-secondary">🖨️ Print
                Summary</a>
            <a href="{{ route('cases.print', ['case' => $case->id, 'pdf' => 1]) }}" class="btn btn-outline-primary">⬇️
                Download PDF</a>
            <h5>Immunizations (Child)</h5>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Vaccine</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($case->immunizationRecords as $record)
                    <tr>
                        <td>{{ $record->schedule->vaccine_name }}</td>
                        <td>{{ $record->given_date }}</td>
                        <td>{{ $record->is_given ? '✅' : '❌' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <!-- ANC Visits Tab -->
        <div class="tab-pane fade" id="anc" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5>ANC Visits</h5>
                <a href="{{ route('cases.anc-visits.create', $case->id) }}" class="btn btn-sm btn-primary">Add ANC
                    Visit</a>
            </div>

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Weight</th>
                        <th>BP</th>
                        <th>FHR</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($case->ancVisits as $visit)
                    <tr>
                        <td>{{ $visit->visit_date }}</td>
                        <td>{{ $visit->weight }} kg</td>
                        <td>{{ $visit->bp_systolic }}/{{ $visit->bp_diastolic }}</td>
                        <td>{{ $visit->fetal_heart_rate }}</td>
                        <td>{{ $visit->notes }}</td>
                    </tr>
                    @endforeach
                    @if($case->ancVisits->isEmpty())
                    <tr>
                        <td colspan="5">No ANC visits recorded.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Delivery Tab -->
        <div class="tab-pane fade" id="delivery" role="tabpanel">
            <h5 class="mb-2">Delivery Details</h5>
            @if($case->delivery)
            <table class="table table-sm">
                <tr>
                    <th>Date</th>
                    <td>{{ $case->delivery->delivery_date }}</td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>{{ $case->delivery->delivery_type }}</td>
                </tr>
                <tr>
                    <th>Complications</th>
                    <td>{{ $case->delivery->complications }}</td>
                </tr>
            </table>
            @else
            <p>No delivery recorded yet.</p>
            <a href="{{ route('cases.deliveries.create', $case->id) }}" class="btn btn-sm btn-primary">Record
                Delivery</a>
            @endif
        </div>
<!-- Babies Tab -->
<div class="tab-pane fade" id="babies" role="tabpanel">
    <h5 class="mb-2">Babies</h5>

    @if($case->delivery && $case->delivery->babies->count())
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Weight</th>
                    <th>Apgar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($case->delivery->babies as $baby)
                    <tr>
                        <td>
                            {{ $baby->patient ? $baby->patient->full_name : ($baby->name ?? '-') }}
                        </td>
                        <td>
                            {{ $baby->patient ? ucfirst($baby->patient->gender) : ucfirst($baby->gender ?? '-') }}
                        </td>
                        <td>{{ $baby->birth_weight ?? '-' }} kg</td>
                        <td>{{ $baby->apgar_score ?? '-' }}</td>
                        <td>{{ ucfirst($baby->status ?? '-') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('deliveries.babies.create', $case->delivery->id) }}" class="btn btn-sm btn-primary">
            Add Another Baby
        </a>
    @else
        <p>No baby data available yet.</p>
        @if($case->delivery)
            <a href="{{ route('deliveries.babies.create', $case->delivery->id) }}" class="btn btn-sm btn-primary">
                Add Baby
            </a>
        @endif
    @endif
</div>

    </div>
</div>
@endsection
