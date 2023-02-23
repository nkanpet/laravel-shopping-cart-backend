<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request->username, $request->password);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid username or password'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login success',
            'token' => $user->createToken('AppToken')->accessToken
        ], 200);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => 'Logout success'
        ], 200);
    }
}
