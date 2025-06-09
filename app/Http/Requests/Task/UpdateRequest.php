<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['string', 'max:30'],
            'description' => ['string'],
            'status' => ['nullable', 'string', 'in:in progress,completed,canceled'],
            'priority' => ['nullable', 'string', 'in:low,medium,high'],
            'deadline' => ['date'],
            'assigned_user_id' => ['nullable', 'int', 'exists:users,id']
        ];
    }
}
