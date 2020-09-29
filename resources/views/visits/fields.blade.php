<!-- Patient Id Field-->
{!! Form::hidden('patient_id', $patient->id) !!}

<!-- Visit Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('visit_date', 'Tanggal Kunjungan:') !!}
    {!! Form::text('visit_date', null, ['class' => 'form-control','id'=>'visit_date']) !!}
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
<div class="form-group col-sm-6">
    {!! Form::label('complaint', 'Keluhan:') !!}
    {!! Form::text('complaint', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Diagnosis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diagnosis', 'Diagnosa:') !!}
    {!! Form::text('diagnosis', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Medication Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medication', 'Obat:') !!}
    {!! Form::text('medication', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('visits.index', [$patient->id]) }}" class="btn btn-secondary">Kembali</a>
</div>