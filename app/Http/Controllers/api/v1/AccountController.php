<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\RegisterRequest;
use App\Http\Resources\User\AccountResource;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function register(RegisterRequest $request): AccountResource
    {
        return $request->register();
    }

    public function login()
    {

    }

    public function logout()
    {

    }
}
