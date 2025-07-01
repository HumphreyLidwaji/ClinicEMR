@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Sample Collections</h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        
                        <th>Order ID</th>
                        <th>Patient Name</th>
                        <th>Sample Type</th>
                        <th>Collected At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sampleCollections as $sample)
                    <tr>
                        
                        <td>{{ $sample->order->id ?? 'N/A' }}</td>
                        <td>{{ optional($sample->patient)->first_name ?? 'N/A' }}</td>

                        <td>{{ $sample->sample_type }}</td>
                        <td>{{ $sample->collected_at }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="p-3">
                {{ $sampleCollections->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
