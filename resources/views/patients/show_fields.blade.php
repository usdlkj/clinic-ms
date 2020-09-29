<!-- Registration Number Field -->
<div class="form-group">
    {!! Form::label('registration_number', 'No Registrasi:') !!}
    <p>{{ $patient->registration_number }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nama:') !!}
    <p>{{ $patient->name }}</p>
</div>

<!-- Birth Date Field -->
<div class="form-group">
    {!! Form::label('birth_date', 'Tanggal Lahir:') !!}
    <p>{{ $patient->birth_date }}</p>
</div>

<!-- Age Field -->
<div class="form-group">
    {!! Form::label('age', 'Usia:') !!}
    <p>{{ $patient->age }}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', 'Alamat:') !!}
    <p>{{ $patient->address }}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', 'No Telepon:') !!}
    <p>{{ $patient->phone }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $patient->email }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $patient->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $patient->updated_at }}</p>
</div>

