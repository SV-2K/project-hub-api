<?php

namespace App\Http\Requests\Account;

use App\Facades\Account;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'email' => ['required', 'email'],
            'password' => ['required', 'array'],
            'password.value' => ['required', 'min:6', 'max:30'],
            'password.confirmation' => ['required', 'confirmed:password.value']
        ];
    }

    public function register()
    {
        return Account::createAccount($this->validated());
    }
}
