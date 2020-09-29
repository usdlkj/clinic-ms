<div class="table-responsive-sm">
    <table class="table table-striped" id="users-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>

                    <div class='btn-group'>
                        <a href="{{ route('users.show', [$user->id]) }}" class='btn btn-ghost-success'><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-ghost-info'><i
                                class="fa fa-edit"></i></a>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                        @if (is_null($user->email_verified_at))
                        {!! Form::open(['route' => ['users.verify', $user->id], 'method' => 'patch']) !!}
                        {!! Form::button('<i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-ghost-success', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                        @endif
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>