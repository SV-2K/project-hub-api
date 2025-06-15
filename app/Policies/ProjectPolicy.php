<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

class ProjectPolicy
{
    public function __construct(
        private UserRepository $repository
    )
    {}

    public function view(User $user, Project $project): Response
    {
        $userRole = $this->repository->getRole($user, $project);

        return $user->id === $project->user_id
            ||
            $userRole === 'executor'
            ||
            $userRole === 'manager'
            ? Response::allow()
            : Response::deny('');
    }

    public function update(User $user, Project $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny('Only owner can update the project');
    }

    public function delete(User $user, Project $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny('Only owner can delete the project');
    }

    public function assign(User $user, Project $project): Response
    {
        $userRole = $this->repository->getRole($user, $project);

        return $user->id === $project->user_id
            ||
            $userRole === 'manager'
            ? Response::allow()
            : Response::deny('Only owner and managers can assign users to a project');
    }
}
