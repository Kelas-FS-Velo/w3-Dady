<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $credentials =$request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ],
            'data' => [
                'user' => $user,
            ],
        ]);

    }
    public function logout(){

    }
    public function me(){

    }
    public function register(Request $request){
        $request->validate([

            'role' => 'required|string|in:user' ,
        ]);

        $user = UsersModel::create([
            'email' => $request->email,
            'password' => $request->password,
            'fullname' => $request->fullname,
            'address' => $request->address,
            'bod' => $request->bod,
            'role' => $request->role,
        ]);

        $token= Auth::login($user);

                return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
                ]);
    }
}
