<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="CoreUI Template - InfyOm Laravel Generator">
    <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/v4-shims.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css"
          rel="stylesheet">

    <style>
        body { background: #eef1f7; }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 860px;
            display: flex;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(31, 50, 129, 0.18);
        }

        /* Left: form panel */
        .login-form-panel {
            flex: 1;
            background: #fff;
            padding: 3rem 2.5rem;
        }

        .login-form-panel h1 {
            font-size: 1.7rem;
            font-weight: 700;
            color: #1f3281;
            margin-bottom: 0.25rem;
        }

        .login-form-panel .text-muted { font-size: 0.88rem; margin-bottom: 1.5rem; display: block; }

        .login-form-panel .form-control:focus {
            border-color: #1f3281;
            box-shadow: 0 0 0 3px rgba(31, 50, 129, 0.12);
        }

        .login-form-panel .input-group-text {
            background: #f4f6fb;
            border-color: #dee2e6;
            color: #6c757d;
        }

        .btn-login {
            background: #1f3281;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1.75rem;
            font-weight: 600;
            transition: all 0.18s ease;
        }

        .btn-login:hover {
            background: #172561;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(31, 50, 129, 0.3);
        }

        /* Right: brand panel */
        .login-brand-panel {
            width: 42%;
            flex-shrink: 0;
            background: linear-gradient(150deg, #1f3281 0%, #152261 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Subtle diagonal grid pattern */
        .login-brand-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(
                    45deg,
                    rgba(255,255,255,0.035) 0px,
                    rgba(255,255,255,0.035) 1px,
                    transparent 1px,
                    transparent 22px
                ),
                repeating-linear-gradient(
                    -45deg,
                    rgba(255,255,255,0.035) 0px,
                    rgba(255,255,255,0.035) 1px,
                    transparent 1px,
                    transparent 22px
                );
        }

        .login-brand-panel > * { position: relative; z-index: 1; }

        .login-brand-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            font-size: 1.8rem;
        }

        .login-brand-panel h2 {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 0.01em;
        }

        .login-brand-panel .brand-address {
            font-size: 0.82rem;
            opacity: 0.75;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .login-brand-panel .brand-tagline {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            opacity: 0.55;
            border-top: 1px solid rgba(255,255,255,0.2);
            padding-top: 1rem;
            width: 80%;
        }

        @media (max-width: 767px) {
            .login-brand-panel { display: none; }
            .login-form-panel { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body class="app">
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-form-panel">
            <h1>Login</h1>
            <span class="text-muted">Silakan login ke akun Anda</span>
            <form method="post" action="{{ url('/login') }}">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="Password" name="password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>
                <div class="row align-items-center">
                    <div class="col-6">
                        <button class="btn btn-login" type="submit">Login</button>
                    </div>
                    <div class="col-6 text-right">
                        <a class="btn btn-link px-0 text-muted" style="font-size:0.85rem"
                           href="{{ url('/password/reset') }}">Forgot password?</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="login-brand-panel">
            <div class="login-brand-icon">
                <i class="fas fa-hospital"></i>
            </div>
            <h2>Klinik Dr. Hardja</h2>
            <p class="brand-address">Jl Kemanggisan Ilir No. 33<br>Jakarta Barat</p>
            <p class="brand-tagline">Sistem Informasi Manajemen Klinik</p>
        </div>
    </div>
</div>
<!-- CoreUI and necessary plugins-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>
</body>
</html>
