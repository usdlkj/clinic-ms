<!-- Name Field -->
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label">Nama:</label>
    <div class="col-md-8">
        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" readonly>
    </div>
</div>

<!-- Email Field -->
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label">Email:</label>
    <div class="col-md-8">
        <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control" readonly>
    </div>
</div>

<!-- Email Verified At Field -->
@if (!is_null($user->email_verified_at))
<div class="form-group row">
    <label for="email_verified_at" class="col-md-4 col-form-label">Verifikasi:</label>
    <div class="col-md-8">
        <input type="text" id="email_verified_at" name="email_verified_at" value="{{ date_format($user->email_verified_at, 'd-m-Y H:i:s') }}" class="form-control" readonly>
    </div>
</div>
@endif
