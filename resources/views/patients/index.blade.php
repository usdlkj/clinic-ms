@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Pasien</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        Data Pasien
                        <a class="pull-right" href="{{ route('patients.create') }}"><i
                                class="fa fa-plus-square fa-lg"></i></a>
                    </div>
                    <div class="card-body">
                        
                        @include('patients.table')
                        <div class="pull-right mr-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready( function () {
    $('#patients-table').DataTable();
} );
</script>
@endpush