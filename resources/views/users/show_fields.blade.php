<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nama:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', 'Tanggal & Waktu Verifikasi Email:') !!}
    <p>@php if (!is_null($user->email_verified_at)) echo $user->email_verified_at->format('d-m-y H:m:s') @endphp</p>
</div>

