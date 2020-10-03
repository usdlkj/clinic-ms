<!-- Registration Number Field -->
<div class="form-group row">
    {!! Form::label('registration_number', 'No Registrasi:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('registration_number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Name Field -->
<div class="form-group row">
    {!! Form::label('name', 'Nama:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Birth Date Field -->
<div class="form-group row">
    {!! Form::label('birth_date', 'Tanggal Lahir:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('birth_date', null, ['class' => 'form-control']) !!}
    </div>
</div>

@push('scripts')
   <script type="text/javascript">
           $('#birth_date').datetimepicker({
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

<!-- Age Field -->
<div class="form-group row">
    {!! Form::label('age', 'Usia:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('age', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Address Field -->
<div class="form-group row">
    {!! Form::label('address', 'Alamat:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Phone Field -->
<div class="form-group row">
    {!! Form::label('phone', 'No Telepon:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Email Field -->
<div class="form-group row">
    {!! Form::label('email', 'Email:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>