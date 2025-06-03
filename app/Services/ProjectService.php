<?php

namespace App\Services;

use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;

class ProjectService
{
    public function create($data): ProjectResource
    {
        $project = Project::query()
            ->create($data);
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
}
