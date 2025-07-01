@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Leave Type</h2>
    <form action="{{ route('leave-types.update', $leaveType) }}" method="POST">
        @csrf @method('PUT')
        @include('hr.leave_types.form')
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('leave-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
