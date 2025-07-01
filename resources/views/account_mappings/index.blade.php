
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Account Mappings</h4>
            <a href="{{ route('account-mappings.create') }}" class="btn btn-light btn-sm">Add Mapping</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Entity Type</th>
                            <th>Entity ID</th>
                            <th>Account</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mappings as $mapping)
                        <tr>
                            
<td>
    @php $entity = $mapping->entity(); @endphp
    {{ $entity ? ($entity->name ?? $entity->title ?? $entity->id) : '-' }}
</td>
                            <td>{{ $mapping->entity_id }}</td>
                            <td>{{ $mapping->account->name ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $mappings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection