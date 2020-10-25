@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('visits.index', [$patient->id]) !!}">Kunjungan</a>
    </li>
    <li class="breadcrumb-item active">Buat Kunjungan Baru</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $patient->name }}</strong>
                    </div>
                    <div class="card-body">
                        @include('patients.show_fields')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus-square-o fa-lg"></i>
                        <strong>Buat Kunjungan Baru</strong>
                    </div>
                    {!! Form::open(['route' => ['visits.store', $patient->id]]) !!}
                    <div class="card-body">
                        @include('visits.fields')
                    </div>
                    <div class="card-footer">
                        <!-- Submit Field -->
                        {!! Form::submit('Simpan', ['class' => 'btn kapzet-blue']) !!}
                        <a href="{{ route('visits.index', [$patient->id]) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
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
$('.js-data-example-ajax').select2({
    ajax: {
        url: '/api/visits/diagnosis',
    },
    tags: true
});
</script>
@endpush