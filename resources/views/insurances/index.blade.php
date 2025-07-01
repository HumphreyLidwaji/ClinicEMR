@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Insurance Providers</h3>
        <a href="{{ route('insurances.create') }}" class="btn btn-primary">Add Insurance</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Contact Person</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Account Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($insurances as $insurance)
                        <tr>
                            <td>{{ $insurance->name }}</td>
                            <td>{{ $insurance->code }}</td>
                            <td>{{ $insurance->contact_person }}</td>
                            <td>{{ $insurance->phone }}</td>
                            <td>{{ $insurance->email }}</td>
                           <td> Account: {{ $insurance->account->name ?? 'Not Set' }}</td>

                            <td>
                                <a href="{{ route('insurances.edit', $insurance) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <form action="{{ route('insurances.destroy', $insurance) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No insurance providers found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $insurances->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
