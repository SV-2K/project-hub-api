<?php

namespace App\Traits;

use App\Models\Project;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\Response;

trait PolicyHelpers
{
    public function __construct(
        private UserRepository $repository
    )
    {}

    public function canAccess(
        User    $user,
        Project $project,
        array   $roles = [],
        string  $denyMessage = 'You are not a part of this project'
    ): Response
    {
        $userRole = $this->repository->getRole($user, $project);

        return $user->id === $project->user_id
            || in_array($userRole, $roles)
            ? Response::allow()
            : Response::deny($denyMessage);
    }
}
