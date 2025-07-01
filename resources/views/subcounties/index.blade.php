@extends('layouts.app')

@section('content')
<h2>Subcounties</h2>
<a href="{{ route('subcounties.create') }}" class="btn btn-primary mb-3">Add Subcounty</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Constituency</th>
        <th>Ward</th>
        <th>Alias</th>
        <th>County</th>
        <th>Actions</th>
    </tr>
    @foreach ($subcounties as $subcounty)
    <tr>
        <td>{{ $subcounty->id }}</td>
        <td>{{ $subcounty->constituency_name }}</td>
        <td>
            @if($subcounty->wards->count())
            <ul class="mb-0">
                @foreach($subcounty->wards as $ward)
                <li>{{ $ward->ward_name }}</li>
                @endforeach
            </ul>
            @else
            <em>No wards</em>
            @endif
        </td>

        <td>{{ $subcounty->alias }}</td>
        <td>{{ $subcounty->county->county_name }}</td>
        <td>
            <a href="{{ route('subcounties.edit', $subcounty->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('subcounties.destroy', $subcounty->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this subcounty?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
