@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('contenido')
    <div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
        
        <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">
            
            <h2 style="text-align: center; color: #1a202c; margin-bottom: 30px;">Ferretería - Iniciar sesión</h2>

            @if ($errors->any())
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568;">Correo electrónico</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;"
                    >
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568;">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;"
                    >
                </div>

                <div style="margin-bottom: 25px; display: flex; align-items: center;">
                    <input type="checkbox" name="remember" id="remember" value="1" style="margin-right: 8px;">
                    <label for="remember" style="color: #4a5568; font-size: 14px;">Recordarme</label>
                </div>

                <button type="submit" style="width: 100%; background-color: #0d6efd; color: white; padding: 12px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    Iniciar sesión
                </button>
            </form>

            <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #4a5568;">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" style="color: #0d6efd; text-decoration: none; font-weight: bold;">Registrarse</a>
            </p>

        </div>
    </div>
@endsection