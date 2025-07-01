@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Enter Results for Order #{{ $order->id }} - Patient: {{ $order->visit->patient->first_name }}</h3>

    <form method="POST" action="{{ route('lab_results.store') }}">
        @csrf

        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="form-group">
            <label>Select Template (optional):</label>
            <select name="template_id" id="template_id" class="form-control">
                <option value="">-- None --</option>
                @foreach($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="results-fields" class="mt-3">
            <!-- Dynamic fields -->
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Results</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const templates = @json($templates);

    function parseRange(rangeStr) {
        // Expects format like "13.0–17.0"
        const parts = rangeStr.replace(/\s/g, '').split(/[–-]/);
        const min = parseFloat(parts[0]);
        const max = parseFloat(parts[1]);
        return { min, max };
    }

    function autoFlagResult(inputEl, flagEl, rangeStr) {
        const val = parseFloat(inputEl.value);
        if (isNaN(val)) {
            flagEl.value = '';
            inputEl.classList.remove('is-valid', 'is-invalid');
            return;
        }

        const { min, max } = parseRange(rangeStr);

        if (val < min) {
            flagEl.value = 'Low';
            inputEl.classList.add('is-invalid');
            inputEl.classList.remove('is-valid');
        } else if (val > max) {
            flagEl.value = 'High';
            inputEl.classList.add('is-invalid');
            inputEl.classList.remove('is-valid');
        } else {
            flagEl.value = 'Normal';
            inputEl.classList.add('is-valid');
            inputEl.classList.remove('is-invalid');
        }
    }

    document.getElementById('template_id').addEventListener('change', function () {
        const selectedId = parseInt(this.value);
        const selectedTemplate = templates.find(t => t.id === selectedId);
        const container = document.getElementById('results-fields');
        container.innerHTML = '';

        if (selectedTemplate && selectedTemplate.fields) {
            selectedTemplate.fields.forEach((field, index) => {
                const fieldId = `result_${index}`;
                const flagId = `flag_${index}`;

                container.innerHTML += `
                    <div class="form-group mt-3">
                        <label><strong>${field.name}</strong> ${field.unit ? '(' + field.unit + ')' : ''}</label>
                        <input type="text" id="${fieldId}" name="results[${field.name}][value]" class="form-control" placeholder="Enter result">

                        ${field.ref_range ? `<small class="form-text text-muted">Reference: ${field.ref_range}</small>` : ''}

                        <label class="mt-1">Flag</label>
                        <select id="${flagId}" name="results[${field.name}][flag]" class="form-control">
                            <option value="">-- Select Flag --</option>
                            <option value="Low">Low</option>
                            <option value="Normal">Normal</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                `;

                // After inserting HTML, attach event listeners for auto-flag
                setTimeout(() => {
                    const inputEl = document.getElementById(fieldId);
                    const flagEl = document.getElementById(flagId);
                    if (field.ref_range) {
                        inputEl.addEventListener('input', () => autoFlagResult(inputEl, flagEl, field.ref_range));
                    }
                }, 0);
            });
        } else {
            container.innerHTML = `
                <div class="form-group mt-3">
                    <label>General Result</label>
                    <textarea name="results[general]" class="form-control" rows="3"></textarea>
                </div>`;
        }
    });

    // Trigger once on load
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('template_id').dispatchEvent(new Event('change'));
    });
</script>
@endsection
