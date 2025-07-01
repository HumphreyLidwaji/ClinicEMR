@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Leave Type</h2>
    <form action="{{ route('leave-types.store') }}" method="POST">
        @csrf
        @include('hr.leave_types.form')
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('leave-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
