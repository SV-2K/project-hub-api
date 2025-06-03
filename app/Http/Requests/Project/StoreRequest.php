<?php

namespace App\Http\Requests\Project;

use App\Http\Resources\Project\ProjectResource;
use Illuminate\Foundation\Http\FormRequest;
use App\Facades\Project;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'description' => ['nullable', 'string']
        ];
    }

    public function store(): ProjectResource
    {
        return Project::create($this->validated());
    }
}
