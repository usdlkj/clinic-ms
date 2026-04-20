<!-- Patient Id Field-->
@if (isset($patient))
<input type="hidden" name="patient_id" value="{{ $patient->id }}">
@endif

<!-- Visit Date Field -->
<div class="form-group row">
    <label for="visit_date" class="col-md-4 col-form-label">Tanggal Kunjungan:</label>
    <div class="col-md-8">
        <input type="text" id="visit_date" name="visit_date" value="{{ old('visit_date', isset($visit) ? $visit->visit_date->format('d-m-Y') : null) }}" class="form-control">
    </div>
</div>

@push('scripts')
<script type="text/javascript">
$('#visit_date').datetimepicker({
    format: 'DD-MM-YYYY',
    useCurrent: true,
    icons: {
        up: "icon-arrow-up-circle icons font-2xl",
        down: "icon-arrow-down-circle icons font-2xl"
    },
    sideBySide: true
})
</script>
@endpush

<!-- Complaint Field -->
<div class="form-group row">
    <label for="complaint" class="col-md-4 col-form-label">Keluhan:</label>
    <div class="col-md-8">
        <textarea id="complaint" name="complaint" class="form-control" rows="5">{{ old('complaint', $visit->complaint ?? null) }}</textarea>
    </div>
</div>

<!-- Diagnosis Field -->
<div class="form-group row">
    <label for="diagnosis" class="col-md-4 col-form-label">Diagnosa:</label>
    <div class="col-md-8">
        <select id="diagnosis" name="diagnosis" class="form-control"></select>
    </div>
</div>

<!-- Medication Field -->
<div class="form-group row">
    <label for="medication" class="col-md-4 col-form-label">Obat:</label>
    <div class="col-md-8">
        <textarea id="medication" name="medication" class="form-control" rows="5">{{ old('medication', $visit->medication ?? null) }}</textarea>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
$('#diagnosis').select2({
    ajax: {
        url: '/api/visits/diagnosis',
    },
    tags: true
});
</script>
@endpush
