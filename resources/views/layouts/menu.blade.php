<li class="nav-item {{ Request::is('patients*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('patients.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Pasien</span>
    </a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Pengguna</span>
    </a>
</li>
