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
    <h2>Create Allowance</h2>

    <form action="{{ route('allowances.store') }}" method="POST">
        @csrf
        @include('hr.allowances.form')

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('allowances.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
