@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('visits.index', $visit->patient_id) }}">Kunjungan</a>
    </li>
    <li class="breadcrumb-item active">Detil</li>
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
                        <strong>Detil Kunjungan</strong>
                        <a href="{{ route('visits.index', $visit->patient_id) }}" class="btn btn-light">Back</a>
                    </div>
                    <div class="card-body">
                        @include('visits.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection