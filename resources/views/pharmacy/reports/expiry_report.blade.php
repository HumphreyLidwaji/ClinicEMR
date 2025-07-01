@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Expiry Report</h4>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Drug</th>
                <th>Expiry Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drugs as $drug)
                @if($drug->expiry_date)
                <tr>
                    <td>{{ $drug->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($drug->expiry_date)->format('Y-m-d') }}</td>
                    <td>
                        @if(\Carbon\Carbon::parse($drug->expiry_date)->isPast())
                            <span class="badge bg-danger">Expired</span>
                        @elseif(\Carbon\Carbon::parse($drug->expiry_date)->diffInDays(now()) <= 30)
                            <span class="badge bg-warning text-dark">Expiring Soon</span>
                        @else
                            <span class="badge bg-success">Valid</span>
                        @endif
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
