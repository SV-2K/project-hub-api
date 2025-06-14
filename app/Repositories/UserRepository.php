<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function getRole(User $user, Project $project): string|null
    {
        $userRole = DB::table('assigned_users_roles')
            ->where('user_id', '=', $user->id)
            ->where('project_id', '=', $project->id)
            ->select('role_id')
            ->first();

        if(!is_null($userRole)) {
            $userRole = DB::table('roles')
                ->find($userRole->role_id)
                ->role;
        }

        return $userRole;
    }
}
