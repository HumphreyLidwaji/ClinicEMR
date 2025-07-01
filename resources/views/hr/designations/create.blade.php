@extends('layouts.app')

@section('content')
<div class="container">
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
    <h2>Create Designation</h2>

    <form action="{{ route('designations.store') }}" method="POST">
        @csrf
        @include('hr.designations.form')

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('designations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
