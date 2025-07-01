@extends('layouts.app')

@section('content')
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
<h1>Designations</h1>
<a href="{{ route('designations.create') }}">Add Designation</a>
<ul>
    @foreach ($designations as $designation)
        <li>{{ $designation->name }} - <a href="{{ route('designations.show', $designation) }}">View</a></li>
    @endforeach
</ul>
@endsection
