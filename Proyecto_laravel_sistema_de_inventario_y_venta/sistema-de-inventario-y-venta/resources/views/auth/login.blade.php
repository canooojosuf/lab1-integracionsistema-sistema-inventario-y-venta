@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('contenido')
    <h1>Ferretería - Iniciar sesión</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div>
            <label for="email">Correo electrónico:</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
            >
        </div>

        <br>

        <div>
            <label for="password">Contraseña:</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            >
        </div>

        <br>

        <label>
            <input type="checkbox" name="remember" value="1">
            Recordarme
        </label>

        <br><br>

        <button type="submit">Iniciar sesión</button>
    </form>

    <p>
        ¿No tienes cuenta?
        <a href="{{ route('register') }}">Registrarse</a>
    </p>
@endsection