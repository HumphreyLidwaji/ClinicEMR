@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">System Configuration</h1>

    <form action="{{ route('configuration.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="hospital_name" class="form-label">Hospital Name</label>
            <input type="text" class="form-control" id="hospital_name" name="hospital_name" value="{{ $settings->hospital_name ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="timezone" class="form-label">Timezone</label>
            <select class="form-control" id="timezone" name="timezone">
                <option value="UTC">UTC</option>
                <option value="Asia/Kolkata">Asia/Kolkata</option>
                <!-- Add more options -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
