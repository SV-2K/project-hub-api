<?php

namespace App\Services;

use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use App\Models\Project as ProjectModel;
use App\Models\User;
use App\Notifications\UserAssignedToProject;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    public function list(): ResourceCollection
    {
        $userProjects = Project::query()
            ->where('user_id', '=', auth()->user()->id)
            ->get();
        return ProjectResource::collection($userProjects);
    }

    public function create($data): ProjectResource
    {
        $project = Project::query()
            ->create([
                'user_id' => auth()->user()->id,
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        return new ProjectResource($project);
    }

    public function change(Project $project, array $data): ProjectResource
    {
        $project->update([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        return new ProjectResource($project);
    }

    public function assignUser(Project $project, array $data): array
    {
        $user = User::query()
            ->find($data['user_id']);
        $assignment = DB::table('assigned_users_roles')
            ->where('user_id', '=', $user->id)
            ->where('project_id', '=', $project->id)
            ->get();

        if ($assignment->isEmpty()) {
            DB::table('assigned_users_roles')
                ->insert([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                    'role_id' => $data['role_id']
                ]);

            $user->notify(new UserAssignedToProject($project));

            return [
                'message' => 'success'
            ];
        } else {
            return [
                'error' => 'this user is already assigned to this project'
            ];
        }
    }

    public function unassignUser(ProjectModel $project, int $userId): void
    {
        DB::table('assigned_users_roles')
            ->where('user_id', '=', $userId)
            ->where('project_id', '=', $project->id)
            ->delete();
    }
}
