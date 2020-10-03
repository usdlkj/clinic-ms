@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('visits.index', $visit->patient_id) !!}">Kunjungan</a>
    </li>
    <li class="breadcrumb-item active">Ubah</li>
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
                        <i class="fa fa-edit fa-lg"></i>
                        <strong>Ubah Data Kunjungan</strong>
                    </div>
                    {!! Form::model($visit, ['route' => ['visits.update', $visit->id], 'method' => 'patch']) !!}
                    <div class="card-body">
                        @include('visits.fields')
                    </div>
                    <div class="card-footer">
                        <!-- Submit Field -->
                        {!! Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) !!}
                        <a href="{{ route('visits.index', $visit->patient_id) }}" class="btn btn-sm btn-secondary">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection