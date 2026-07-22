@extends('layouts.applogin')

@section('title', 'Inicia sesión')

@section('content')
    <style>
        body {
            @apply antialiased bg-gradient-to-br from-green-100 via-lime-100 to-green-200;
        }

        .icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 20px;
        }

        .login-box {
            background-color: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 3rem auto;
        }

        .login-box-msg {
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            color: #065f46; /* verde oscuro */
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background-color: #059669; /* Tailwind emerald-500 */
            border-color: #059669;
        }

        .btn-primary:hover {
            background-color: #047857; /* emerald-600 */
        }

        .btn-secondary {
            background-color: #a3e635; /* lime-400 */
            border-color: #a3e635;
            color: black;
        }

        .btn-secondary:hover {
            background-color: #84cc16; /* lime-600 */
        }

        .btn-link {
            color: #065f46;
            text-align: center;
            display: block;
            font-weight: 500;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .input-group-text {
            border-radius: 0 0.5rem 0.5rem 0;
        }
    </style>

    <div class="login-box">
            <div class="icon-container">
            <img src="{{ secure_asset('assets/cow-ufo.gif') }}" width="120"
                height="100" alt="icono de dron" title="icono de dron" class="img-small">
        </div>
        <div>
            <p class="login-box-msg">Inicio de Sesión</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email" name="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                    </div>
                    <div class="col-6">
                        <a href="register" class="btn btn-secondary btn-block">Registrarse</a>
                    </div>
                </div>
            </form>
            <div class="col-12">
                @if (Route::has('password.request'))
                    <a class="btn btn-link col-12" href="{{ route('password.request') }}">
                        ¿Olvidó su contraseña?
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
