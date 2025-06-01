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
}
