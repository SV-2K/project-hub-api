<?php

namespace App\Http\Requests\Project;

use App\Facades\Project as ProjectService;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class UnassignRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['int', 'exists:users,id']
        ];
    }

    public function unassign(Project $project): void
    {
        ProjectService::unassignUser($project, $this->validated()['user_id']);
    }
}
