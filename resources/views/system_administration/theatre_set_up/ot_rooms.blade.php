@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Operation Theatre Rooms</h2>

    <a href="#" class="btn btn-primary mb-3">Add OT Room</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Room Name</th>
                <th>Floor</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop here --}}
        </tbody>
    </table>
</div>
@endsection
