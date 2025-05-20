<?php

namespace App\Services;

use App\Facades\Account;
use App\Http\Resources\User\AccountResource;
use App\Models\User;
use \Illuminate\Http\JsonResponse;

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

    public function signIn(array $data): JsonResponse|array
    {
        if (!auth()->attempt($data)) {
            return response()->json([
                'message' => 'Invalid user credentials'
            ], 400);
        }

        $token = auth()->user()->createToken('api-token')->plainTextToken;
        return [
            'token' => $token
        ];
    }
}
