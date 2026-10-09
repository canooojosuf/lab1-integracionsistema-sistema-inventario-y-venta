@extends('layouts.app')

@section('titulo', 'Crear cuenta')

@section('contenido')
    <h1>Ferretería - Crear cuenta</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nombre completo:</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                maxlength="255"
                required
                autocomplete="name"
            >
        </div>

        <br>

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
                minlength="8"
                required
                autocomplete="new-password"
            >
        </div>

        <br>

        <div>
            <label for="password_confirmation">
                Confirmar contraseña:
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                minlength="8"
                required
                autocomplete="new-password"
            >
        </div>

        <br>

        <button type="submit">Crear cuenta</button>
    </form>

    <p>
        ¿Ya tienes cuenta?
        <a href="{{ route('login') }}">Iniciar sesión</a>
    </p>
@endsection