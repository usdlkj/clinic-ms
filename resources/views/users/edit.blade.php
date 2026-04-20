@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('users.index') !!}">Pengguna</a>
    </li>
    <li class="breadcrumb-item active">Perbarui</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('common.errors')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit fa-lg"></i>
                        <strong>Perbarui Pengguna</strong>
                    </div>
                    <form method="POST" action="{{ route('users.update', $user->id) }}">@csrf @method('PATCH')
                    <div class="card-body">
                        @include('users.fields_update')
                    </div>
                    <div class="card-footer">
                        <!-- Submit Field -->
                        <button type="submit" class="btn kapzet-blue">Save</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
