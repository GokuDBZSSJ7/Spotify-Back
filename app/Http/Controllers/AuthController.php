<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // Valida os dados do formulário
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Verifica se há erros de validação
        if ($validator->fails()) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Obtém os dados validados
        $credentials = $validator->validated();

        // Tenta autenticar o usuário
        if (! $token = JWTAuth::attempt($credentials)) {
            // Falha na autenticação
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Autenticação bem-sucedida, retorna o token JWT
        return response()->json(['token' => $token]);
    }
}
