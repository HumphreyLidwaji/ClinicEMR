@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Designation</h2>
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
    <form action="{{ route('designations.update', $designation) }}" method="POST">
        @csrf
        @method('PUT')
        @include('hr.designations.form')

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('designations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
