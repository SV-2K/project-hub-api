<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use App\Traits\PolicyHelpers;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use PolicyHelpers;
    public function viewAny(User $user, Task $task): Response
    {
        $project = $task->project;
        return $this->canAccess($user, $project, ['manager', 'executor']);
    }

    public function create(User $user, Task $task): Response
    {
        $project = $task->project;
        return $this->canAccess($user, $project, ['manager', 'executor']);
    }

    public function delete(User $user, Comment $comment): Response
    {
        $project = $comment->task->project;
        return $this->canAccess($user, $project, ['manager', 'executor']);
    }
}
