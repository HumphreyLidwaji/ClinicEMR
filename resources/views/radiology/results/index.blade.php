@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Radiology Results</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

  

    <table class="table table-bordered">
        <thead>
            <tr>
             
                <th>Test</th>
                <th>Resulted By</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($results as $res)
            <tr>
          
                <td>{{ $res->test_name }}</td>
                <td>{{ $res->resulted_by }}</td>
                <td>{{ $res->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('radiology.results.show', $res->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
