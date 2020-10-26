@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('patients.index') !!}">Pasien</a>
    </li>
    <li class="breadcrumb-item active">Buat Baru</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        {!! Form::open(['route' => 'patients.storePatientVisit']) !!}
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus-square-o fa-lg"></i>
                        <strong>Pasien</strong>
                    </div>
                    <div class="card-body">
                        @include('patients.fields')
                    </div>
                    <div class="card-footer">
                        <!-- Submit Field -->
                        {!! Form::submit('Save', ['class' => 'btn kapzet-blue']) !!}
                        <a href="{{ route('patients.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus-square-o fa-lg"></i>
                        <strong>Kunjungan</strong>
                    </div>
                    <div class="card-body">
                        @include('visits.fields')
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('styles')
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
$('#diagnosis').select2({
    ajax: {
        url: '/api/visits/diagnosis',
    },
    tags: true
});
</script>
@endpush