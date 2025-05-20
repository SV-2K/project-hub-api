<?php

namespace App\Http\Requests\Account;

use App\Facades\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }

    public function login(): JsonResponse|array
    {
        return Account::signIn($this->validated());
    }
}
