
@extends('layouts.app')

@section('title', 'ICD11 Codes')

@section('content')
<div class="container-fluid py-4">
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
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">ICD11 Codes</h4>
                    <div>
                        <a href="{{ asset('templates/icd11_template.xlsx') }}" class="btn btn-outline-light btn-sm me-2">
                            <i class="bi bi-download"></i> Download Template
                        </a>
                        <a href="{{ route('icd11.import.form') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-upload"></i> Import Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20%;">Code</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($icd11s as $icd)
                                    <tr>
                                        <td>{{ $icd->code }}</td>
                                        <td>{{ $icd->description }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">No ICD11 codes found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $icd11s->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection