@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Radiology Result Detail</h2>

    <p><strong>Test:</strong> {{ $result->test_name }}</p>
    <p><strong>Resulted By:</strong> {{ $result->resulted_by }}</p>
    <p><strong>Remarks:</strong> {{ $result->remarks }}</p>
</div>
    <div class="mt-3">
        <a href="{{ route('radiology.results.index') }}" class="btn btn-secondary">Back to Results</a>
    </div>  
</div>
@endsection
