@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('users.index') !!}">Pengguna</a>
    </li>
    <li class="breadcrumb-item active">Buat Baru</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus-square-o fa-lg"></i>
                        <strong>Buat Pengguna Baru</strong>
                    </div>
                    {!! Form::open(['route' => 'users.store']) !!}
                    <div class="card-body">
                        @include('users.fields_create')
                    </div>
                    <div class="card-footer">
                        <!-- Submit Field -->
                        {!! Form::submit('Save', ['class' => 'btn kapzet-blue']) !!}
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection