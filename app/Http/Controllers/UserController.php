<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        // Возвращаем информацию о текущем пользователе
        return response()->json($request->user()->only(['name', 'email']));
    }
}
