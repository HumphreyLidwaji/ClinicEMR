@extends('layouts.app')

@section('title', 'Print Surgery Reports')

@section('content')
<div class="container">
    <h1 class="mb-4">Print Surgery Reports</h1>
    <form action="{{ route('theatre.reports.print') }}" method="GET" target="_blank">
        <div class="form-group">
            <label>From Date</label>
            <input type="date" name="from" class="form-control">
        </div>
        <div class="form-group">
            <label>To Date</label>
            <input type="date" name="to" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Print</button>
    </form>
</div>
@endsection
