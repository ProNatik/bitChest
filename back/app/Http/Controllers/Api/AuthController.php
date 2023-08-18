<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
        return response()->json([
        'message' => 'Invalid login details'
                ], 401);
            }

        $user = User::where('username', $request['username'])->firstOrFail();

        $token = $user->createToken(time())->plainTextToken;

        return response()->json([
                'token' => $token,
                'role' => $user->role
        ]);
    }
    public function logout()
    {
        Auth::logout();

        return response()->json('logout');
    }

}
