<!-- Registration Number Field -->
<div class="form-group row">
    <label for="registration_number" class="col-md-3 col-form-label">No Registrasi:</label>
    <div class="col-md-9">
        <input type="text" id="registration_number" name="registration_number" value="{{ $patient->registration_number }}" class="form-control" readonly>
    </div>
</div>

<!-- Name Field -->
<div class="form-group row">
    <label for="name" class="col-md-3 col-form-label">Nama:</label>
    <div class="col-md-9">
        <input type="text" id="name" name="name" value="{{ $patient->name }}" class="form-control" readonly>
    </div>
</div>

<!-- Birth Date Field -->
<div class="form-group row">
    <label for="birth_date" class="col-md-3 col-form-label">Tanggal Lahir:</label>
    <div class="col-md-9">
        @if (isset($patient->birth_date))
        <input type="text" id="birth_date" name="birth_date" value="{{ date_format($patient->birth_date, 'd-m-Y') }}" class="form-control" readonly>
        @else
        <input type="text" id="birth_date" name="birth_date" value="" class="form-control" readonly>
        @endif
    </div>
</div>

<!-- Age Field -->
<div class="form-group row">
    <label for="age" class="col-md-3 col-form-label">Usia:</label>
    <div class="col-md-9">
        <input type="text" id="age" name="age" value="{{ $patient->age }}" class="form-control" readonly>
    </div>
</div>

<!-- Address Field -->
<div class="form-group row">
    <label for="address" class="col-md-3 col-form-label">Alamat:</label>
    <div class="col-md-9">
        <textarea id="address" name="address" class="form-control" rows="5" readonly>{{ $patient->address }}</textarea>
    </div>
</div>

<!-- Phone Field -->
<div class="form-group row">
    <label for="phone" class="col-md-3 col-form-label">No Telepon:</label>
    <div class="col-md-9">
        <input type="text" id="phone" name="phone" value="{{ $patient->phone }}" class="form-control" readonly>
    </div>
</div>

<!-- Email Field -->
<div class="form-group row">
    <label for="email" class="col-md-3 col-form-label">Email:</label>
    <div class="col-md-9">
        <input type="text" id="email" name="email" value="{{ $patient->email }}" class="form-control" readonly>
    </div>
</div>
