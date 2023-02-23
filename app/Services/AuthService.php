<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($username, $password)
    {
        $user = $this->userRepository->findOne(['email' => $username]);

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }
}
