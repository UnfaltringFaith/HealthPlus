<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        // Возвращаем информацию о текущем пользователе
        return response()->json($request->user()->only(['name', 'email', 'avatar_url']));
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        Log::info('Method called, raw input:', $request->all());
        Log::info('Files:', $request->allFiles());

        $user = $request->user();
        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'image|nullable'
        ]);


        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('images/avatars', 'public');
            $data['avatar'] = $path;
        }

        Log::info('Avatar path:', ['name' => $request->input('name')]);

        $user->update($data);

        return response()->json($user);
    }
}
