<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\PolicyHelpers;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use PolicyHelpers;

    public function __construct(
        private UserRepository $repository
    )
    {}

    private function getProject(Task $task): Project
    {
        return $task->project;
    }

    public function viewAny(User $user, Project $project): Response
    {
        return $this->canAccess($user, $project, ['manager', 'executor']);
    }

    public function view(User $user, Task $task): Response
    {
        $project = $this->getProject($task);
        return $this->canAccess($user, $project, ['manager', 'executor']);
    }

    public function create(User $user, Project $project): Response
    {
        return $this->canAccess($user, $project, ['manager'], 'Only managers can create tasks');
    }

    public function update(User $user, Task $task): Response
    {
        $project = $this->getProject($task);
        return $this->canAccess($user, $project, ['manager', 'executor']);
    }

    public function delete(User $user, Task $task): Response
    {
        $project = $this->getProject($task);
        return $this->canAccess($user, $project, ['manager'], 'Only managers can update tasks');
    }
}
