@extends('layouts.app')

@section('title', 'Edit ' . $title)

@section('content')
<div class="container py-4">
    <h4>Edit {{ $title }} for Visit #{{ $visit->id }}</h4>

    <form method="POST" action="{{ route('orders.update-bulk', [$visit->id, $type]) }}">
        @csrf
        <input type="hidden" name="visit_id" value="{{ $visit->id }}">

        <div class="mb-3">
            <label for="services_select" class="form-label">{{ $title }}</label>
            <select name="services[]" id="services_select" class="form-select select2" multiple required>
                @foreach($items as $item)
                <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                    {{ $item->name }} - KES {{ number_format($item->price, 2) }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount (KES)</label>
            <input type="number" name="total" id="total_amount" class="form-control" readonly required>
        </div>

        <button class="btn btn-primary">Update Orders</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.select2').select2();

        function updateTotal() {
            let total = 0;
            $('#services_select option:selected').each(function () {
                let price = parseFloat($(this).data('price'));
                if (!isNaN(price)) total += price;
            });
            $('#total_amount').val(total.toFixed(2));
        }

        $('#services_select').on('change', updateTotal);
        updateTotal();
    });
</script>
@endpush
