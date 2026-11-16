@extends('layouts.app')

@section('titulo', 'Crear cuenta')

@section('contenido')
    <div style="display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 20px 0;">
        
        <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 450px;">
            
            <h2 style="text-align: center; color: #1a202c; margin-bottom: 30px;">Ferretería - Crear cuenta</h2>

            @if ($errors->any())
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 15px;">
                    <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568;">Nombre completo</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        maxlength="255"
                        required
                        autocomplete="name"
                        style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;"
                    >
                </div>

                <div style="margin-bottom: 15px;">
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

                <div style="margin-bottom: 15px;">
                    <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568;">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        minlength="8"
                        required
                        autocomplete="new-password"
                        style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;"
                    >
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568;">Confirmar contraseña</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        minlength="8"
                        required
                        autocomplete="new-password"
                        style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;"
                    >
                </div>

                <button type="submit" style="width: 100%; background-color: #198754; color: white; padding: 12px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    Crear cuenta
                </button>
            </form>

            <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #4a5568;">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" style="color: #0d6efd; text-decoration: none; font-weight: bold;">Inicia sesión aquí</a>
            </p>

        </div>
    </div>
@endsection