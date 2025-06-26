<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class UnassignRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['int', 'exists:users,id']
        ];
    }
}
