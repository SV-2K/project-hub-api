<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Traits\PolicyHelpers;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

class ProjectPolicy
{
    use PolicyHelpers;
    public function view(User $user, Project $project): Response
    {
        return $this->canAccess($user, $project, ['executor', 'manager']);
    }

    public function update(User $user, Project $project): Response
    {
        return $this->canAccess($user, $project, denyMessage: 'Only owner can update the project');
    }

    public function delete(User $user, Project $project): Response
    {
        return $this->canAccess($user, $project, denyMessage: 'Only owner can delete the project');
    }

    public function assign(User $user, Project $project): Response
    {
        return $this->canAccess($user, $project, ['manager'], 'Only owner and managers can assign users to a project');
    }

    public function unassign(User $user, Project $project, int $unassigningUserId): Response
    {
        // Assigned user can unassign himself from the project
        if ($user->id === $unassigningUserId) {
            return Response::allow();
        }
        return $this->canAccess($user, $project, ['manager']);
    }
}
