<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function funLogin(Request $request)
    {
        // validar datos
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // verificar si el correo y contraseña son correctos
        if(!Auth::attempt($credentials)){
            return response()->json(['mensaje' => 'Credenciales incorrectas'], 401);
        }
        // generar un token
        // $token = $request->user()->createToken('Token Auth')->plaintTextToken;
        $token = $request->user()->createToken('Token Auth')->plainTextToken;
        // responder
        return response()->json(['access_token' => $token, 'user' => $request->user()]);
    }

    public function funRegister(Request $request)
    {

    }

    public function funProfile(Request $request)
    {
        $user = $request->user();
        return response()->json($user);
    }

    public function funLogout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json();
    }
}
