<div class="mb-3">
    <label for="allowance_name" class="form-label">Allowance Name</label>
    <input type="text" class="form-control @error('allowance_name') is-invalid @enderror" 
           id="allowance_name" name="allowance_name" 
           value="{{ old('allowance_name', $allowance->allowance_name ?? '') }}" required>
    @error('allowance_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Amount</label>
    <input type="number" class="form-control @error('amount') is-invalid @enderror" 
           id="amount" name="amount" step="0.01" 
           value="{{ old('amount', $allowance->amount ?? '') }}" required>
    @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description (optional)</label>
    <textarea class="form-control @error('description') is-invalid @enderror" 
              id="description" name="description" rows="3">{{ old('description', $allowance->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
