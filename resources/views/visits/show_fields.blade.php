<!-- Visit Date Field -->
<div class="form-group row">
    {!! Form::label('visit_date', 'Tanggal Kunjungan:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('visit_date', $visit->visit_date->format('d-m-Y'), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Complaint Field -->
<div class="form-group row">
    {!! Form::label('complaint', 'Keluhan:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('complaint', $visit->complaint, ['class' => 'form-control', 'readonly', 'rows' => '5']) !!}
    </div>
</div>

<!-- Diagnosis Field -->
<div class="form-group row">
    {!! Form::label('diagnosis', 'Diagnosa:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('diagnosis', $visit->diagnosis, ['class' => 'form-control', 'readonly', 'rows' => '5']) !!}
    </div>
</div>

<!-- Medication Field -->
<div class="form-group row">
    {!! Form::label('medication', 'Obat:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('medication', $visit->medication, ['class' => 'form-control', 'readonly', 'rows' => '5']) !!}
    </div>
</div>