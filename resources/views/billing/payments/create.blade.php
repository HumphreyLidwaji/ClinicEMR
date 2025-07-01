@extends('layouts.app')

@section('title', 'Receive Payment')

@section('content')
<div class="container-fluid py-4">
    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h4 class="mb-4">{{ __('Receive Payment') }}</h4>
            <form action="{{ route('billing.payments.store') }}" method="POST">

                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Select Invoice') }}</label>
                    <select name="invoice_id" class="form-control" required>
                        @foreach ($invoices as $invoice)
                        <option value="{{ $invoice->id }}"
                            {{ (isset($invoiceId) && $invoiceId == $invoice->id) ? 'selected' : '' }}>
                            {{ $invoice->invoice_number }} - {{ $invoice->patient_name }} ({{ $invoice->amount }})
                        </option>
                        @endforeach
                    </select>
                </div>

            @if($invoice)
    <table class="table mb-3">
        <thead>
            <tr>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Amount to Pay') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ number_format($item->total, 2) }}</td>
                <td>
                    <input type="hidden" name="items[{{ $item->id }}][id]" value="{{ $item->id }}">
                    <input type="number" name="items[{{ $item->id }}][amount_paid]"
                        step="0.01"
                        max="{{ $item->total - $item->amount_paid }}"
                        class="form-control"
                        placeholder="0.00">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif



                <div class="mb-3">
                    <label class="form-label">{{ __('Payment Method') }}</label>
                    <select name="method" id="payment-method" class="form-control" required>
                        <option value="Cash">{{ __('Cash') }}</option>
                        <option value="Card">{{ __('Card') }}</option>
                        <option value="Mpesa">{{ __('Mpesa') }}</option>
                        <option value="Insurance">{{ __('Insurance') }}</option>
                    </select>
                </div>


                <div class="mb-3" id="insurance-section" style="display: none;">
                    <label class="form-label">{{ __('Insurance Provider') }}</label>
                    <select name="insurance_id" class="form-control">
                        <option value="">-- Select Insurance --</option>
                        @foreach ($insurances as $insurance)
                        <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="mb-3">
                    <label class="form-label">{{ __('Amount') }}</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>

                <button class="btn btn-primary">{{ __('Record Payment') }}</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const methodSelect = document.getElementById('payment-method');
        const insuranceSection = document.getElementById('insurance-section');

        function toggleInsurance() {
            if (methodSelect.value === 'Insurance') {
                insuranceSection.style.display = 'block';
            } else {
                insuranceSection.style.display = 'none';
            }
        }

        methodSelect.addEventListener('change', toggleInsurance);
        toggleInsurance(); // initial check in case form reloads with value
    });

</script>
@endpush

@endsection
