<!-- Patient Id Field -->
<div class="form-group">
    {!! Form::label('patient_id', 'Pasien:') !!}
    <p>{{ $visit->patient->name }}</p>
</div>

<!-- Visit Date Field -->
<div class="form-group">
    {!! Form::label('visit_date', 'Tanggal Kunjungan:') !!}
    <p>{{ $visit->visit_date->format('d-m-y') }}</p>
</div>

<!-- Complaint Field -->
<div class="form-group">
    {!! Form::label('complaint', 'Keluhan:') !!}
    <p>{{ $visit->complaint }}</p>
</div>

<!-- Diagnosis Field -->
<div class="form-group">
    {!! Form::label('diagnosis', 'Diagnosa:') !!}
    <p>{{ $visit->diagnosis }}</p>
</div>

<!-- Medication Field -->
<div class="form-group">
    {!! Form::label('medication', 'Obat:') !!}
    <p>{{ $visit->medication }}</p>
</div>

