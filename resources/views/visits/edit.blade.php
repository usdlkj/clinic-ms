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
                        {!! Form::submit('Save', ['class' => 'btn kapzet-blue']) !!}
                        <a href="{{ route('visits.index', $visit->patient_id) }}" class="btn btn-sm btn-secondary">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
$('#diagnosis').select2({
    ajax: {
        url: '/api/visits/diagnosis',
    },
    tags: true
});

// Fetch the preselected item, and add to the control
var diagnosisSelect = $('#diagnosis');
$.ajax({
    type: 'GET',
    url: '/api/visit/diagnosis/{{$visit->id}}'
}).then(function (data) {
    // create the option and append to Select2
    var option = new Option('{{$visit->diagnosis}}', '{{$visit->diagnosis}}', true, true);
    diagnosisSelect.append(option).trigger('change');

    // manually trigger the `select2:select` event
    diagnosisSelect.trigger({
        type: 'select2:select',
        params: {
            data: data
        }
    });
});
</script>
@endpush