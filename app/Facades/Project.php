<?php

namespace App\Facades;

use App\Http\Resources\Project\ProjectResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Facade;
use App\Services\ProjectService;
use App\Models\Project as ProjectModel;

/* @see ProjectService
 *
 * @method static ProjectResource create(array $data)
 * @method static ProjectResource change(ProjectModel $project, array $data)
 * @method static array assignUser(ProjectModel $project, array $data)
 * @method static ResourceCollection list()
 */

class Project extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'project_service';
    }
}
