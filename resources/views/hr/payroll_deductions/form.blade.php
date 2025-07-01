<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $payrollDeduction->name ?? '') }}" class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Amount</label>
    <input type="number" step="0.01" name="amount" value="{{ old('amount', $payrollDeduction->amount ?? '') }}" class="form-control @error('amount') is-invalid @enderror">
    @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $payrollDeduction->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
