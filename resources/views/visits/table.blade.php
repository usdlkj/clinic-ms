<div class="table-responsive-sm">
    <table class="table table-striped" id="visits-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Diagnosa</th>
                <th>Obat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
            <tr>
                <td>{{ $visit->visit_date->format('d-m-y') }}</td>
                <td>{{ $visit->complaint }}</td>
                <td>{{ $visit->diagnosis }}</td>
                <td>{{ $visit->medication }}</td>
                <td>
                    {!! Form::open(['route' => ['visits.destroy', $visit->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('visits.show', [$visit->id]) }}" class='btn btn-ghost-success'><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('visits.edit', [$visit->id]) }}" class='btn btn-ghost-info'><i
                                class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>