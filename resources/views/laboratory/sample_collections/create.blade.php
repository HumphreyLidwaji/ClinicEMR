
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
      
        <div class="card-body">
            <form action="{{ route('sample_collections.store') }}" method="POST">
                @csrf
                   <input type="hidden" name="order_id" value="{{ $orderId }}">
                <div class="mb-3">
                    <label class="form-label">Sample Type</label>
                    <select name="sample_type" class="form-select form-control" required>
                        <option value="">Select Type</option>
                        <option value="blood">Blood</option>
                        <option value="urine">Urine</option>
                        <option value="swab">Swab</option>
                    </select>
                </div>
                <button class="btn btn-success">Mark as Collected</button>
            </form>
        </div>
    </div>
</div>
@endsection