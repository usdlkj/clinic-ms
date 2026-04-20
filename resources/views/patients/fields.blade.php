<!-- Registration Number Field -->
<div class="form-group row">
    <label for="registration_number" class="col-md-3 col-form-label">No Registrasi:</label>
    <div class="col-md-9">
        <input type="text" id="registration_number" name="registration_number" value="{{ old('registration_number', $patient->registration_number ?? null) }}" class="form-control">
    </div>
</div>

<!-- Name Field -->
<div class="form-group row">
    <label for="name" class="col-md-3 col-form-label">Nama:</label>
    <div class="col-md-9">
        <input type="text" id="name" name="name" value="{{ old('name', $patient->name ?? null) }}" class="form-control">
    </div>
</div>

<!-- Birth Date Field -->
<div class="form-group row">
    <label for="birth_date" class="col-md-3 col-form-label">Tanggal Lahir:</label>
    <div class="col-md-9">
        <input type="text" id="birth_date" name="birth_date" value="{{ old('birth_date', isset($patient->birth_date) ? $patient->birth_date->format('d-m-Y') : null) }}" class="form-control">
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
    <label for="age" class="col-md-3 col-form-label">Usia:</label>
    <div class="col-md-9">
        <input type="text" id="age" name="age" value="{{ old('age', $patient->age ?? null) }}" class="form-control">
    </div>
</div>

<!-- Address Field -->
<div class="form-group row">
    <label for="address" class="col-md-3 col-form-label">Alamat:</label>
    <div class="col-md-9">
        <textarea id="address" name="address" class="form-control" rows="5">{{ old('address', $patient->address ?? null) }}</textarea>
    </div>
</div>

<!-- Phone Field -->
<div class="form-group row">
    <label for="phone" class="col-md-3 col-form-label">No Telepon:</label>
    <div class="col-md-9">
        <input type="text" id="phone" name="phone" value="{{ old('phone', $patient->phone ?? null) }}" class="form-control">
    </div>
</div>

<!-- Email Field -->
<div class="form-group row">
    <label for="email" class="col-md-3 col-form-label">Email:</label>
    <div class="col-md-9">
        <input type="text" id="email" name="email" value="{{ old('email', $patient->email ?? null) }}" class="form-control">
    </div>
</div>
