
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Wards</h4>
            <a href="{{ route('wards.create') }}" class="btn btn-light btn-sm">Add Ward</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Beds</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wards as $ward)
                        <tr>
                            <td>{{ $ward->name }}</td>
                            <td>{{ $ward->description }}</td>
                            <td>{{ $ward->beds_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection