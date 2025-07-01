@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Surgical Teams</h2>

    <a href="#" class="btn btn-primary mb-3">Add Surgical Team</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Team Name</th>
                <th>Surgeon</th>
                <th>Assistants</th>
                <th>Nurses</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop here --}}
        </tbody>
    </table>
</div>
@endsection
