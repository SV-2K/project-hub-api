<?php

namespace App\Facades;

use App\Http\Resources\Project\ProjectResource;
use Illuminate\Support\Facades\Facade;
use App\Services\ProjectService;
use App\Models\Project as ProjectModel;

/* @see ProjectService
 *
 * @method static ProjectResource create(array $data)
 * @method static ProjectResource change(ProjectModel $project, array $data)
 */

class Project extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'project_service';
    }
}
