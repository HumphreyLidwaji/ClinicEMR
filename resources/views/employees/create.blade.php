@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Add New Employee</h4>
    <form method="POST" action="{{ route('employees.store') }}">
        @include('employees.form')
    </form>
</div>
@endsection
