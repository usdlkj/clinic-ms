<!-- Registration Number Field -->
<div class="form-group row">
    {!! Form::label('registration_number', 'No Registrasi:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('registration_number', $patient->registration_number, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Name Field -->
<div class="form-group row">
    {!! Form::label('name', 'Nama:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('name', $patient->name, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Birth Date Field -->
<div class="form-group row">
    {!! Form::label('birth_date', 'Tanggal Lahir:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('birth_date', date_format($patient->birth_date, 'd-m-Y'), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Age Field -->
<div class="form-group row">
    {!! Form::label('age', 'Usia:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('age', $patient->age, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Address Field -->
<div class="form-group row">
    {!! Form::label('address', 'Alamat:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('address', $patient->address, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Phone Field -->
<div class="form-group row">
    {!! Form::label('phone', 'No Telepon:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('phone', $patient->phone, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Email Field -->
<div class="form-group row">
    {!! Form::label('email', 'Email:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('email', $patient->email, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>