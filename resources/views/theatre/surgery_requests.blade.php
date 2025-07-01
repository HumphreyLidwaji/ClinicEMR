@extends('layouts.app')

@section('title', 'Surgery Requests')

@section('content')
<div class="container">
    <h1 class="mb-4">Surgery Requests</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Requested Procedure</th>
                <th>Requested By</th>
                <th>Scheduled Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop surgery requests -->
        </tbody>
    </table>
</div>
@endsection
