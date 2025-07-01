@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Procedure Types</h2>

    <a href="#" class="btn btn-primary mb-3">Add Procedure Type</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Procedure Name</th>
                <th>Specialty</th>
                <th>Estimated Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop here --}}
        </tbody>
    </table>
</div>
@endsection
