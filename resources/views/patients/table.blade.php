<div class="table-responsive-sm">
    <table class="table table-striped" id="patients-table">
        <thead>
            <tr>
                <th>No Registrasi</th>
                <th>Nama</th>
                <th>Tanggal Periksa</th>
                <th>Usia</th>
                <th>Alamat</th>
                <th>Keluhan</th>
                <th>Diagnosa</th>
                <th>Obat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->registration_number }}</td>
                <td><a href="{{ route('patients.edit', [$patient->id]) }}"><i class="fa fa-edit"></i>
                        {{ $patient->name }}</a></td>
                <td><a href="{{ route('visits.index', [$patient->id]) }}"><i class="fa fa-eye"></i>
                        {{ $patient->last_visit }}</a></td>
                <td>{{ $patient->age }}</td>
                <td>{{ $patient->address }}</td>
                <td>{{ $patient->complaint }}</td>
                <td><span class="badge-diagnosis">{{ $patient->diagnosis }}</span></td>
                <td>{{ $patient->medication }}</td>
                <td>
                    <form method="POST" action="{{ route('patients.destroy', $patient->id) }}">@csrf @method('DELETE')
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-ghost-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                    </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
