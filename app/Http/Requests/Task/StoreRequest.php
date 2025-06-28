<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use App\Facades\Task as TaskService;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:6', 'max:30'],
            'description' => ['string'],
            'status' => ['nullable', 'string', 'in:in progress,completed,canceled'],
            'priority' => ['nullable', 'string', 'in:low,medium,high'],
            'deadline' => ['required', 'date'],
            'assigned_user_id' => ['nullable', 'int', 'exists:users,id']
        ];
    }

    public function store(int $projectId): Task|array
    {
        return TaskService::create($projectId, $this->validated());
    }
}
