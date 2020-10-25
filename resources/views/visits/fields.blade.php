<!-- Patient Id Field-->
@if (isset($patient))
{!! Form::hidden('patient_id', $patient->id) !!}
@endif

<!-- Visit Date Field -->
<div class="form-group row">
    {!! Form::label('visit_date', 'Tanggal Kunjungan:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('visit_date', null, ['class' => 'form-control']) !!}
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
    {!! Form::label('complaint', 'Keluhan:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('complaint', null, ['class' => 'form-control', 'rows' => '5']) !!}
    </div>
</div>

<!-- Diagnosis Field -->
<div class="form-group row">
    {!! Form::label('diagnosis', 'Diagnosa:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        <select id="diagnosis" name="diagnosis" class="form-control js-data-example-ajax"></select>
    </div>
</div>

<!-- Medication Field -->
<div class="form-group row">
    {!! Form::label('medication', 'Obat:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('medication', null, ['class' => 'form-control', 'rows' => '5']) !!}
    </div>
</div>