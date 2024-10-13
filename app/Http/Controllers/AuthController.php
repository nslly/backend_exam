<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $requestValidated = $request->validate([
            'name' => "required|string",
            'email' => "required|string|email|unique:users",
            'password' => "required|string|confirmed"
        ]);

        $user = User::create($requestValidated);

        $token = $user->createToken($request->email);

        return [
            "message" => "Registeration Success",
            "data" => $token,
        ];
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => "required|string",
            'password' => "required|string"
        ]);

        $user = User::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized User'], 401);
        }

        $token = $user->createToken($request->login)->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);
    }


    
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ])->withCookie(cookie('token', '', -1));
    }
}
