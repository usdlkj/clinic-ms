@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('patients.index') }}">Pasien</a>
            </li>
            <li class="breadcrumb-item active">Data Pasien</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Data Pasien</strong>
                                  <a href="{{ route('patients.index') }}" class="btn btn-light">Back</a>
                             </div>
                             <div class="card-body">
                                 @include('patients.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
