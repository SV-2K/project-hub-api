<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\LoginRequest;
use App\Http\Requests\Account\RegisterRequest;
use App\Http\Resources\User\AccountResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function register(RegisterRequest $request): array
    {
        return $request->register();
    }

    public function login(LoginRequest $request): JsonResponse|array
    {
        return $request->login();
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
