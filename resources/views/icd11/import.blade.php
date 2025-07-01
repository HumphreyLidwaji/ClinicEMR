
@extends('layouts.app')

@section('title', 'Import ICD11 Codes')

@section('content')
<div class="container py-4">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <div class="card">
        <div class="card-header">Import ICD11 Excel</div>
        <div class="card-body">
            <form method="POST" action="{{ route('icd11.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Excel File</label>
                    <input type="file" name="file" class="form-control" required accept=".xlsx,.xls,.csv">
                </div>
                <button class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
</div>
@endsection