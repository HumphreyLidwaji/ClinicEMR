
<div class="mb-3">
    <label class="form-label" for="name">Designation Name</label>
    <input type="text" name="name" id="name" 
           value="{{ old('name', $designation->name ?? '') }}" 
           class="form-control @error('name') is-invalid @enderror" 
           placeholder="Enter designation name">

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="description">Description</label>
    <textarea name="description" id="description" rows="3" 
              class="form-control @error('description') is-invalid @enderror" 
              placeholder="Enter description (optional)">{{ old('description', $designation->description ?? '') }}</textarea>
    
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
