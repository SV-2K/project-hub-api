<?php

namespace App\Services;

use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use App\Models\Project as ProjectModel;
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
        $assignment = DB::table('assigned_users_roles')
            ->where('user_id', '=', $data['user_id'])
            ->where('project_id', '=', $project->id);

        if (empty($assignment->get()->toArray())) {
            DB::table('assigned_users_roles')
                ->insert([
                    'user_id' => $data['user_id'],
                    'project_id' => $project->id,
                    'role_id' => $data['role_id']
                ]);

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
