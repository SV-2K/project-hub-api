<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\AssignRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ProjectController extends Controller
{
    public function index(): ResourceCollection
    {
        return ProjectResource::collection(Project::all());
    }

    public function store(StoreRequest $request): ProjectResource
    {
        return $request->store();
    }

    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project);
    }

    public function update(UpdateRequest $request, Project $project): ProjectResource
    {
        return $request->change($project);
    }

    public function destroy(Project $project): void
    {
        $project->delete();
    }

    public function assign(AssignRequest $request, Project $project): array
    {
        return $request->assign($project);
    }
}
