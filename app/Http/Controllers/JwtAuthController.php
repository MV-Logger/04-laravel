<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class JwtAuthController extends Controller
{
    public function login(Request $request)
    {
        $req = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:5',
        ]);
        if ($req->fails()) {
            return response()->json($req->errors(), 422);
        }
        if (!$token = auth()->attempt($req->validated())) {
            return response()->json(['Auth error' => 'Unauthorized'], 401);
        }
        return $this->generateToken($token);
    }

    protected function generateToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function register(Request $request)
    {
        $req = Validator::make($request->all(), [
            'username' => 'required|string|between:2,100|unique:users',
            'password' => 'required|string|min:5',
        ]);

        if ($req->fails()) {
            return response()->json($req->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $req->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User signed up',
            'user' => $user
        ], 201);
    }

    public function signout()
    {
        auth()->logout();
        return response()->json(['message' => 'User logged out']);
    }

    public function refresh()
    {
        return $this->generateToken(auth()->refresh());
    }

    public function user()
    {
        return response()->json(auth()->user());
    }
}
