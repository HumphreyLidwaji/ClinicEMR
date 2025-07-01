@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Lab Result Templates</h3>

    <a href="{{ route('laboratory.templates.create') }}" class="btn btn-primary mb-3">+ Create New Template</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Fields</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($templates as $template)
            <tr>
                <td>{{ $template->name }}</td>
                <td>
                    <ul class="mb-0">
                        @foreach($template->fields as $field)
                        <li>
                            {{ $field['name'] }}
                            @if(!empty($field['unit']))
                            ({{ $field['unit'] }})
                            @endif
                            @if(!empty($field['ref_range']))
                            - Ref: {{ $field['ref_range'] }}
                            @endif
                            @if(!empty($field['flag']))
                            - <strong>{{ $field['flag'] }}</strong>
                            @endif
                        </li>

                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('laboratory.templates.edit', $template->id) }}"
                        class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('laboratory.templates.destroy', $template->id) }}" method="POST"
                        style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this template?')"
                            class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
