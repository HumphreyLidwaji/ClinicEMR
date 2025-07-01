
@extends('layouts.app')
@section('title', 'Dosages')
@section('content')
<div class="container py-4">
    <a href="{{ route('dosages.create') }}" class="btn btn-primary mb-3">Add Dosage</a>
    <table class="table table-bordered">
        <thead><tr><th>Description</th><th>Action</th></tr></thead>
        <tbody>
            @foreach($dosages as $dosage)
                <tr>
                    <td>{{ $dosage->description }}</td>
                    <td>
                        <a href="{{ route('dosages.edit', $dosage) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection