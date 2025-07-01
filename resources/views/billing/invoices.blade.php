@extends('layouts.app')

@section('title', 'Invoices')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Invoices</h4>
            <a href="{{ route('billing.invoices.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Create Invoice
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice #</th>
                            <th>Patient</th>
                            <th>Visit Type</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Issued At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices ?? [] as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ $invoice->patient_name }}</td>
                            <td>{{ $invoice->visit_type }}</td>
                            <td>{{ number_format($invoice->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $invoice->status == 'Paid' ? 'success' : 'warning' }}">
                                    {{ $invoice->status }}
                                </span>
                            </td>
                            <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('billing.invoices.show', $invoice->id) }}" class="btn btn-sm btn-info mb-1">
                                    View
                                </a>

                                <a href="{{ route('billing.invoices.print', $invoice->id) }}" class="btn btn-sm btn-secondary mb-1" target="_blank">
                                    Print
                                </a>

                                <a href="{{ route('billing.payments.create', $invoice->id) }}" class="btn btn-sm btn-success mb-1">
                                    Receive Payment
                                </a>

                                @if($invoice->visit_id)
                                <a href="{{ route('billing.visit-orders.show', $invoice->visit_id) }}" class="btn btn-sm btn-warning mb-1">
                                    Bill More Orders
                                </a>
                                @endif
                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No invoices found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
