<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'min:3', 'max:255']
        ];
    }
}
