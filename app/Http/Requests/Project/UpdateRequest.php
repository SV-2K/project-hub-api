<?php

namespace App\Http\Requests\Project;

use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use App\Facades\Project as ProjectService;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'min:3', 'max:30'],
            'description' => ['nullable', 'string']
        ];
    }

    public function change(Project $project): ProjectResource
    {
        return ProjectService::change($project, $this->validated());
    }
}
