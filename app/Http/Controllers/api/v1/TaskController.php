<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\Task\MinifiedTaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskController extends Controller
{
    public function index(Project $project): ResourceCollection
    {
        return MinifiedTaskResource::collection($project->tasks()->get());
    }

    public function store(StoreRequest $request, Project $project): Task
    {
        return $request->store($project->id);
    }

    public function show(Task $task): Task
    {
        return $task;
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $task->update($request->validated());
        return $task;
    }

    public function destroy(Task $task): void
    {
        $task->delete();
    }
}
