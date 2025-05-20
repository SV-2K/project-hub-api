<?php

namespace App\Services;

use App\Facades\Account;
use App\Http\Resources\User\AccountResource;
use App\Models\User;

class AccountService
{
    public function createAccount(array $data)
    {
        $user = User::query()
            ->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']['value']
            ]);

        return new AccountResource($user);
    }
}
