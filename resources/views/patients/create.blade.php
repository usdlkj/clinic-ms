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
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Buat Pasien Baru</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'patients.store']) !!}

                                   @include('patients.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
