@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Pre/Post-Op Checklists</h2>

    <a href="#" class="btn btn-primary mb-3">Add Checklist</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Checklist Type</th>
                <th>Checklist Name</th>
                <th>Items Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop here --}}
        </tbody>
    </table>
</div>
@endsection
