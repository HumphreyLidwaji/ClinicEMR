@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create Lab Result Template</h3>

    <form action="{{ route('laboratory.templates.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Template Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <hr>

        <h5>Fields</h5>
        <div id="fields-container"></div>

        <button type="button" class="btn btn-secondary mt-2" onclick="addField()">+ Add Field</button>

        <br><br>
        <button type="submit" class="btn btn-primary">Save Template</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
  function addField(name = '', unit = '', ref_range = '', flag = '') {
    const container = document.getElementById('fields-container');
    const index = container.children.length;

    const html = `
        <div class="form-row mb-2 d-flex align-items-center">
            <div class="col">
                <input type="text" name="fields[${index}][name]" class="form-control" placeholder="Field Name" value="${name}" required>
            </div>
            <div class="col">
                <input type="text" name="fields[${index}][unit]" class="form-control" placeholder="Unit" value="${unit}">
            </div>
            <div class="col">
                <input type="text" name="fields[${index}][ref_range]" class="form-control" placeholder="Reference Range" value="${ref_range}">
            </div>
            <div class="col">
                <select name="fields[${index}][flag]" class="form-control">
                    <option value="">-- Flag --</option>
                    <option value="Low" ${flag === 'Low' ? 'selected' : ''}>Low</option>
                    <option value="Normal" ${flag === 'Normal' ? 'selected' : ''}>Normal</option>
                    <option value="High" ${flag === 'High' ? 'selected' : ''}>High</option>
                </select>
            </div>
            <div>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.parentElement.remove()">Remove</button>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', html);
}

</script>
@endsection
