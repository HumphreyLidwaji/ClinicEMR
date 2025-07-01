<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $leaveType->name ?? '') }}" class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $leaveType->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
