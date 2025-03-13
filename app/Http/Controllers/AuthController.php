<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.cadastro');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        Log::info('Credenciais:', $credentials);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'As credenciais informadas não correspondem aos nossos registros.',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login bem-sucedido!',
            'token' => $token,
            'user' => $user,
            'redirect' => route('dashboard'),
        ]);
    }




    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Usuário registrado com sucesso!'], 201);
    }
}
