<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAllByPagination($request->all());

        return view('manage.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userService->getById($id);

        return view('manage.users.show', compact('user'));
    }
}
