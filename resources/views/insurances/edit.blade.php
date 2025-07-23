@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Insurance Provider</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('insurances.update', $insurance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name *</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $insurance->name) }}">
        </div>

        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $insurance->code) }}">
        </div>

        <div class="mb-3">
            <label>Contact Person</label>
            <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $insurance->contact_person) }}">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $insurance->phone) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $insurance->email) }}">
        </div>

          <div class="mb-3">
            <label>Linked Account</label>
            <select name="account_id" class="form-control">
                <option value="">-- Select Account --</option>
                @foreach($accounts as $account)
                <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                    {{ $account->name }} ({{ $account->code }})
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('insurances.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
