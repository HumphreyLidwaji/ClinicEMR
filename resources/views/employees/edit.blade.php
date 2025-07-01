@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Employee</h4>
    <form method="POST" action="{{ route('employees.update', $employee) }}">
        @method('PUT')
        @include('employees.form')
    </form>
</div>
@endsection
