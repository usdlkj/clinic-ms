<!-- Visit Date Field -->
<div class="form-group row">
    <label for="visit_date" class="col-md-4 col-form-label">Tanggal Kunjungan:</label>
    <div class="col-md-8">
        <input type="text" id="visit_date" name="visit_date" value="{{ $visit->visit_date->format('d-m-Y') }}" class="form-control" readonly>
    </div>
</div>

<!-- Complaint Field -->
<div class="form-group row">
    <label for="complaint" class="col-md-4 col-form-label">Keluhan:</label>
    <div class="col-md-8">
        <textarea id="complaint" name="complaint" class="form-control" rows="5" readonly>{{ $visit->complaint }}</textarea>
    </div>
</div>

<!-- Diagnosis Field -->
<div class="form-group row">
    <label for="diagnosis" class="col-md-4 col-form-label">Diagnosa:</label>
    <div class="col-md-8">
        <textarea id="diagnosis" name="diagnosis" class="form-control" rows="5" readonly>{{ $visit->diagnosis }}</textarea>
    </div>
</div>

<!-- Medication Field -->
<div class="form-group row">
    <label for="medication" class="col-md-4 col-form-label">Obat:</label>
    <div class="col-md-8">
        <textarea id="medication" name="medication" class="form-control" rows="5" readonly>{{ $visit->medication }}</textarea>
    </div>
</div>
