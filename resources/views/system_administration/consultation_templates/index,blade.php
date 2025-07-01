@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Consultation Templates</h1>

    <a href="{{ route('consultation-templates.create') }}" class="btn btn-success mb-3">Add Template</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Template Name</th>
                <th>Used For</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($templates as $tpl)
            <tr>
                <td>{{ $tpl->name }}</td>
                <td>{{ $tpl->used_for }}</td>
                <td>
                    <a href="{{ route('consultation-templates.edit', $tpl->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('consultation-templates.destroy', $tpl->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this template?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
