<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotificationCollection;

class NotificationController extends Controller
{
    public function index(): DatabaseNotificationCollection
    {
        return auth()->user()->notifications;
    }
}
