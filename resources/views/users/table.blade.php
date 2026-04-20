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
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}">@csrf @method('DELETE')
                        <button type="submit" class="btn btn-ghost-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                        </form>
                        @if (is_null($user->email_verified_at))
                        <form method="POST" action="{{ route('users.verify', $user->id) }}">@csrf @method('PATCH')
                        <button type="submit" class="btn btn-ghost-success" onclick="return confirm('Are you sure?')"><i class="fa fa-check"></i></button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
