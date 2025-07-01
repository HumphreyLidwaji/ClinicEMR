@extends('layouts.app') {{-- Adjust layout as needed --}}

@section('content')
<div class="container">
    <h2>Lab Result Details</h2>

    <div class="card mt-3">
        <div class="card-header">
            Patient: {{ $labResult->order->visit->patient->full_name ?? 'N/A' }}
        </div>
        <div class="card-body">
            <p><strong>Order ID:</strong> {{ $labResult->order_id }}</p>
            <p><strong>Resulted At:</strong> 
                {{ $labResult->resulted_at ? \Carbon\Carbon::parse($labResult->resulted_at)->format('d M Y H:i') : 'Pending' }}
            </p>
            <p><strong>Resulted By:</strong> {{ $labResult->resulted_by ?? 'N/A' }}</p>
            <p><strong>Remarks:</strong> {{ $labResult->remarks ?? 'N/A' }}</p>

            <h5 class="mt-4">Result Details:</h5>
            <ul>
               @foreach($labResult->results ?? [] as $item)

                    <li><strong>{{ $item['test'] ?? 'N/A' }}:</strong> {{ $item['value'] ?? '' }} {{ $item['unit'] ?? '' }}</li>
                @endforeach
            </ul>

            <a href="{{ route('lab_results.edit', $labResult->id) }}" class="btn btn-warning mt-3">Edit</a>
            <a href="{{ route('lab_results.pdf', $labResult->id) }}" class="btn btn-primary mt-3">Download PDF</a>
            <a href="{{ route('lab_results.index') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
