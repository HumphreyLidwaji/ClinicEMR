@extends('layouts.app')

@section('title', 'Surgery Reports')

@section('content')
<div class="container">
    <h1 class="mb-4">Surgery Reports</h1>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>Patient</th>
                <th>Procedure</th>
                <th>Surgeon</th>
                <th>Outcome</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through reports -->
        </tbody>
    </table>
</div>
@endsection
