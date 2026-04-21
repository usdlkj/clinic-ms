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
        @include('common.errors')
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
                        <i class="fa-regular fa-square-plus fa-lg"></i>
                        <strong>Buat Kunjungan Baru</strong>
                    </div>
                    <form method="POST" action="{{ route('visits.store', $patient->id) }}">@csrf
                    <div class="card-body">
                        @include('visits.fields')
                    </div>
                    <div class="card-footer">
                        <!-- Submit Field -->
                        <button type="submit" class="btn kapzet-blue">Simpan</button>
                        <a href="{{ route('visits.index', [$patient->id]) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
