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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit fa-lg"></i>
                        <strong>Ubah Data Kunjungan</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::model($visit, ['route' => ['visits.update', $visit->id], 'method' => 'patch']) !!}

                        @include('visits.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection