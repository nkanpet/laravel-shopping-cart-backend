<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = $this->userService->create($data);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'success'
        ], 200);
    }
}
