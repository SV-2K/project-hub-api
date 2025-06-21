<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function __construct(
        private UserRepository $repository
    )
    {}

    public function viewAny(User $user, Project $project): Response
    {
        $userRole = $this->repository->getRole($user, $project);

        return $user->id === $project->user_id
            || $userRole === 'manager'
            || $userRole === 'executor'
            ? Response::allow()
            : Response::deny('You are not a part of this project');
    }

    public function view(User $user, Task $task): Response
    {
        $project = $task->project()->first();
        $userRole = $this->repository->getRole($user, $project);

        return $user->id === $project->user_id
            || $userRole === 'manager'
            || $userRole === 'executor'
            ? Response::allow()
            : Response::deny();
    }

    public function create(User $user, Project $project): Response
    {
        $userRole = $this->repository->getRole($user, $project);

        return $user->id === $project->user_id
            || $userRole === 'manager'
            ? Response::allow()
            : Response::deny('Only owner and managers can create tasks');
    }

    public function update(User $user, Task $task): Response
    {
        $project = $task->project()->first();
        $userRole = $this->repository->getRole($user, $project);

        return $user->id === $project->user_id
        || $userRole === 'manager'
        || $userRole === 'executor'
            ? Response::allow()
            : Response::deny('You can\'t update the task until you assigned to this project');
    }

    public function delete(User $user, Task $task): Response
    {
        $project = $task->project()->first();
        $userRole = $this->repository->getRole($user, $project);

        return $user->id === $project->user_id
        || $userRole === 'manager'
            ? Response::allow()
            : Response::deny('Only managers can update tasks');
    }
}
