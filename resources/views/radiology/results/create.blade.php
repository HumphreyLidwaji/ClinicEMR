@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add Radiology Result</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('radiology.results.store') }}" method="POST">
        @csrf

        {{-- Hidden Order ID --}}
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="mb-3">
    <label class="form-label">Test Name</label>
    <input type="text" name="test_name" class="form-control" value="{{ $testName }}" readonly>
</div>


 

        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
