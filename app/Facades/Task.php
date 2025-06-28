<?php

namespace App\Facades;

use App\Services\TaskService;
use Illuminate\Support\Facades\Facade;
use App\Models\Task as TaskModel;

/* @see TaskService
 *
 * @method static TaskModel|array create(int $projectId, array $data)
 */
class Task extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'task_service';
    }
}
