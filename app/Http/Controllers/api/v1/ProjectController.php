<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreRequest $request): ProjectResource
    {
        return $request->store();
    }

    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Project $project)
    {
        $project->delete();
    }

    public function assign()
    {
        //
    }
}
