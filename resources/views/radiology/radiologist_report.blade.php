@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Radiologist Report</h4>

    <form action="#" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Patient</label>
            <input type="text" class="form-control" value="John Doe" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Imaging Type</label>
            <input type="text" class="form-control" value="X-ray Chest" readonly>
        </div>

        <div class="mb-3">
            <label for="findings" class="form-label">Findings</label>
            <textarea class="form-control" id="findings" name="findings" rows="5">Normal chest X-ray findings...</textarea>
        </div>

        <div class="mb-3">
            <label for="impression" class="form-label">Impression</label>
            <textarea class="form-control" id="impression" name="impression" rows="3">No active disease seen.</textarea>
        </div>

        <button class="btn btn-success" type="submit">Save Report</button>
    </form>
</div>
@endsection
