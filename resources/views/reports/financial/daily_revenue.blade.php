@extends('layouts.app')

@section('title', 'Daily Revenue Report')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Daily Revenue Report</h3>

    <form method="GET" action="{{ route('reports.financial.daily_revenue') }}" class="row mb-4">
        <div class="col-md-3">
            <label for="date" class="form-label">Select Date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}" class="form-control">
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    @if(isset($reportData) && count($reportData))
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Invoice No</th>
                    <th>Patient</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportData as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->invoice_no }}</td>
                    <td>{{ $row->patient_name }}</td>
                    <td>{{ $row->service }}</td>
                    <td>{{ number_format($row->amount, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="text-muted">No data available for selected date.</p>
    @endif
</div>
@endsection
