@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Babies for Delivery on {{ optional($delivery->delivery_date)->format('d M Y') }}</h4>

    <a href="{{ route('deliveries.babies.create', $delivery->id) }}" class="btn btn-primary mb-3">Add New Baby</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Birth Weight (kg)</th>
                <th>Apgar Score</th>
                <th>Status</th>
                <th>Immunization</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($delivery->babies as $baby)
                <tr>



                                    <td>
    {{ $baby->patient ? $baby->patient->full_name : ($baby->name ?? '-') }}
</td>
                                     <td>
    {{ $baby->patient ? ucfirst($baby->patient->dob) : ucfirst($baby->dob ?? '-') }}
</td>
                   <td>
    {{ $baby->patient ? ucfirst($baby->patient->gender) : ucfirst($baby->gender ?? '-') }}
</td>
                    <td>{{ $baby->birth_weight ?? '-' }}</td>
                    <td>{{ $baby->apgar_score ?? '-' }}</td>
                    <td>{{ ucfirst($baby->status) ?? '-' }}</td>
                    <td>
                        @if($baby->patient_id && \App\Models\Patient::find($baby->patient_id))
                            <a href="{{ route('immunizations.index', $baby->patient_id) }}" class="btn btn-sm btn-success">
                                💉 Immunizations
                            </a>
                        @else
                            <span class="text-muted small">No patient linked</span>
                        @endif
                    </td>
                    <td>
                        {{-- Edit Baby --}}
                        <a href="{{ route('babies.edit', $baby->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>

                        {{-- Print Birth Certificate --}}
                        <a href="{{ route('babies.print', $baby->id) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            🖨️ Birth Cert
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No babies recorded yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
