<?php

namespace App\Http\Resources\Comment;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'user_name' => User::query()
                ->find(
                    $this->user_id
                )->name,
            'comment' => $this->comment
        ];
    }
}
