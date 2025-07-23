@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sub-County Wards</h2>
    <a href="{{ route('sub_county_wards.create') }}" class="btn btn-primary mb-3">Add Ward</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ward Name</th>
                <th>Subcounty</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wards as $ward)
                <tr>
                    <td>{{ $ward->id }}</td>
                    <td>{{ $ward->ward_name }}</td>
                    <td>{{ $ward->subcounty->constituency_name ?? 'N/A' }}</td>

                    <td>
                        <a href="{{ route('sub_county_wards.edit', $ward) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sub_county_wards.destroy', $ward) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this ward?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $wards->links() }}
</div>
@endsection
