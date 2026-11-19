<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
     public function login(Request $request) 
    { 
        $datos = $request->validate([ 
            'email'       => ['required', 'email'], 
            'password'    => ['required'], 
            'dispositivo' => ['required', 'max:100'],
        ]); 
  
        $user = User::where('email', $datos['email'])->first(); 
  
        if (! $user || ! Hash::check($datos['password'], $user->password)) { 
            throw ValidationException::withMessages([ 
                'email' => 'Las credenciales no coinciden.', 
            ]); 
        } 
  
        $token = $user->createToken($datos['dispositivo']); 
  
        return response()->json([ 
            'token' => $token->plainTextToken, 
            'tipo'  => 'Bearer', 
            ], 201); 
    }

     // Método para cerrar sesión (revocar el token actual)
    public function logout(Request $request)
    {
        // Elimina el token que se usó para esta petición
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }


    public function yo(Request $request) 
    {
        return $request->user()->only('id', 'name', 'email'); 
    }
}
