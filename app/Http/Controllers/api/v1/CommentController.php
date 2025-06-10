<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{
    public function index(Task $task): ResourceCollection
    {
        return CommentResource::collection($task->comments()->get());
    }

    public function store(Task $task, StoreRequest $request): Comment
    {
        $comment = Comment::query()
            ->create([
                'user_id' => auth()->user()->id,
                'task_id' => $task->id,
                'comment' => $request->comment
            ]);
        return $comment;
    }

    public function destroy(Comment $comment): void
    {
        $comment->delete();
    }
}
