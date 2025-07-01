@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Imaging Report Templates</h1>

    <a href="{{ route('imaging-templates.create') }}" class="btn btn-success mb-3">Add Template</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Template Name</th>
                <th>Imaging Type</th>
                <th>Content Preview</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($imagingTemplates as $template)
            <tr>
                <td>{{ $template->name }}</td>
                <td>{{ $template->imagingType->name ?? '-' }}</td>
                <td>{{ Str::limit(strip_tags($template->content), 50) }}</td>
                <td>
                    <a href="{{ route('imaging-templates.edit', $template->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('imaging-templates.destroy', $template->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this template?')">
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
