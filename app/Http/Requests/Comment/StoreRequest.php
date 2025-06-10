<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'int', 'exists:users,id'],
            'comment' => ['required', 'string', 'min:3', 'max:255']
        ];
    }
}
