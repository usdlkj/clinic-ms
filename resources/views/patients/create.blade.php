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
        @include('common.errors')
        <form method="POST" action="{{ route('patients.storePatientVisit') }}">@csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-regular fa-square-plus fa-lg"></i>
                        <strong>Pasien</strong>
                    </div>
                    <div class="card-body">
                        @include('patients.fields')
                    </div>
                    <div class="card-footer">
                        <!-- Submit Field -->
                        <button type="submit" class="btn kapzet-blue">Save</button>
                        <a href="{{ route('patients.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-regular fa-square-plus fa-lg"></i>
                        <strong>Kunjungan</strong>
                    </div>
                    <div class="card-body">
                        @include('visits.fields')
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
