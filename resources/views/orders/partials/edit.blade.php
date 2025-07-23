<form method="POST" action="{{ route('orders.update', [$type, $order->id]) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ $order->quantity }}" min="1" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Unit Price</label>
        <input type="number" name="price" class="form-control" value="{{ $order->price }}" step="0.01" required>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>
