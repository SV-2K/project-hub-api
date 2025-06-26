<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\AssignRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UnassignRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use App\Facades\Project as ProjectService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index(): ResourceCollection
    {
        return ProjectService::list();
    }

    public function store(StoreRequest $request): ProjectResource
    {
        return $request->store();
    }

    public function show(Project $project): ProjectResource
    {
        Gate::authorize('view', $project);
        return new ProjectResource($project);
    }

    public function update(UpdateRequest $request, Project $project): ProjectResource
    {
        Gate::authorize('update', $project);
        return $request->change($project);
    }

    public function destroy(Project $project): void
    {
        Gate::authorize('delete', $project);
        $project->delete();
    }

    public function assign(AssignRequest $request, Project $project): array
    {
        Gate::authorize('assign', $project);
        return $request->assign($project);
    }

    public function unassign(UnassignRequest $request, Project $project): void
    {
        ProjectService::unassignUser($project, $request->user_id);
    }
}
