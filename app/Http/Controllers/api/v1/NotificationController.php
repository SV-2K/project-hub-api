<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Notifications\DatabaseNotificationCollection;

class NotificationController extends Controller
{
    public function index(): ResourceCollection
    {
        return NotificationResource::collection(
            auth()->user()->notifications
        );
    }
}
