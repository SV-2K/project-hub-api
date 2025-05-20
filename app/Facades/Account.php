<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\AccountService;
use App\Http\Resources\User\AccountResource;

/**
 * @see AccountService
 *
 * @method static AccountResource createAccount(array $data)
 * @method static signIn(array $data)
 */
class Account extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'account_service';
    }
}
