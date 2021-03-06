@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">Pengguna</a>
    </li>
    <li class="breadcrumb-item active">Data Pengguna</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Data Pengguna</strong>
                        <a href="{{ route('users.index') }}" class="btn btn-light">Back</a>
                    </div>
                    <div class="card-body">
                        @include('users.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection