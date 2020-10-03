<!-- Name Field -->
<div class="form-group row">
    {!! Form::label('name', 'Nama:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('name', $user->name, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Email Field -->
<div class="form-group row">
    {!! Form::label('email', 'Email:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('email', $user->email, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- Email Verified At Field -->
@if (!is_null($user->email_verified_at))
<div class="form-group row">
    {!! Form::label('email_verified_at', 'Verifikasi:', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('email_verified_at', date_format($user->email_verified_at, 'd-m-Y H:i:s'), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
@endif
