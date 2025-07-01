@extends('layouts.app')

@section('title', 'Capture / Upload Imaging')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h4 class="mb-4">{{ __('Capture / Upload Imaging') }}</h4>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="patient" class="form-label">{{ __('Patient') }}</label>
                    <input type="text" class="form-control" id="patient" value="John Doe" readonly>
                </div>

                <div class="mb-3">
                    <label for="image_type" class="form-label">{{ __('Imaging Type') }}</label>
                    <select class="form-control" name="image_type">
                        <option value="X-ray">{{ __('X-ray') }}</option>
                        <option value="MRI">{{ __('MRI') }}</option>
                        <option value="Ultrasound">{{ __('Ultrasound') }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">{{ __('Upload Image') }}</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>

                <button class="btn btn-primary" type="submit">{{ __('Upload') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection