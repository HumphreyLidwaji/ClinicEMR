@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Allowance</h2>

    <form action="{{ route('allowances.update', $allowance) }}" method="POST">
        @csrf
        @method('PUT')
        @include('hr.allowances.form')

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('allowances.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
