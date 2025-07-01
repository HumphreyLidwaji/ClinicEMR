
@extends('layouts.app')
@section('title', 'Drugs')
@section('content')
<div class="container py-4">
    <a href="{{ route('drugs.create') }}" class="btn btn-primary mb-3">Add Drug</a>
    <table class="table table-bordered">
        <thead><tr><th>Name</th><th>Action</th></tr></thead>
        <tbody>
            @foreach($drugs as $drug)
                <tr>
                    <td>{{ $drug->name }}</td>
                    <td>
                        <a href="{{ route('drugs.edit', $drug) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection