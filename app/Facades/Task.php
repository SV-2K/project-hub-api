<?php

namespace App\Facades;

use App\Services\TaskService;
use Illuminate\Support\Facades\Facade;

/* @see TaskService
 *
 * @method static create(int $projectId, array $data)
 */
class Task extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'task_service';
    }
}
