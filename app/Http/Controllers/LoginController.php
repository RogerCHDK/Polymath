<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validacion
        $this->validateLogin($request);

        // Si el login es correcto
        if (Auth::attempt($request->only('email','password'))) { //Preguntamos si el tenemos ese correo con esa contraseña en nuestro sistema
            return response()->json([
                'token' => $request->user()->createToken($request->name)->plainTextToken,
                'mensaje' => 'Success',
            ]);

        }
        // Si falla el login
        return response()->json([
            'message' => 'Unauthorized'
        ],401);

    }

    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ]); 
    }
}
