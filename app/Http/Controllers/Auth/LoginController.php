<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Аутентификация успешна
            $token = $request->user()->createToken('auth_token')->plainTextToken;
            return response()->json(['message' => 'Успешный вход', 'token' => $token], 200);
        }


        // Аутентификация не удалась
        return response()->json(['message' => 'Неверные учетные данные'], 401);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        
        if ($user) {
            $user->tokens()->delete(); // Удаляем все токены пользователя
            return response()->json(['message' => 'Вы вышли из системы'], 200);
        }

        return response()->json(['message' => 'Пользователь не найден'], 404);
    }
}
