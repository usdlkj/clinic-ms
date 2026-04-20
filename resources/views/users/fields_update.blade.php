<!-- Name Field -->
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label">Nama:</label>
    <div class="col-md-8">
        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? null) }}" class="form-control">
    </div>
</div>

<!-- Email Field -->
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label">Email:</label>
    <div class="col-md-8">
        <input type="text" id="email" name="email" value="{{ old('email', $user->email ?? null) }}" class="form-control">
    </div>
</div>

<!-- Password Field -->
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label">Password:</label>
    <div class="col-md-8">
        <input name="password" type="password" id="password" class="form-control">
    </div>
</div>

<!-- Password Confirmation Field -->
<div class="form-group row">
    <label for="password_confirmation" class="col-md-4 col-form-label">Confirm Password:</label>
    <div class="col-md-8">
        <input name="password_confirmation" type="password" id="password_confirmation" class="form-control">
    </div>
</div>
