@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-success text-white fw-semibold rounded-top-4">
                    Add Ward
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('wards.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Ward Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., Surgical Ward" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" placeholder="Brief description of the ward..." rows="3"></textarea>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-success px-4">Save Ward</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
