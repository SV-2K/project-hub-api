<?php

namespace App\Http\Requests\Project;

use App\Facades\Project as ProjectService;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'int', 'exists:users,id'],
            'role_id' => ['required', 'int', 'exists:roles,id']
        ];
    }

    public function assign(Project $project): array
    {
        return ProjectService::assignUser($project, $this->validated());
    }
}
