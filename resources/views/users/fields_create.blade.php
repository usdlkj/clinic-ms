<!-- Name Field -->
<div class="form-group row">
    {!! Form::label('name', 'Nama:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Email Field -->
<div class="form-group row">
    {!! Form::label('email', 'Email:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Password Field -->
<div class="form-group row">
    {!! Form::label('password', 'Password:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        <input name="password" type="password" id="password" class="form-control">
    </div>
</div>

<!-- Password Confirmation Field -->
<div class="form-group row">
    {!! Form::label('password_confirmation', 'Confirm Password:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        <input name="password_confirmation" type="password" id="password_confirmation" class="form-control">
    </div>
</div>


