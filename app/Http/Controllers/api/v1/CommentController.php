<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use App\Notifications\UserGotCommentOnTask;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index(Task $task): ResourceCollection
    {
        Gate::authorize('viewAny', [Comment::class, $task]);
        return CommentResource::collection($task->comments()->get());
    }

    public function store(Task $task, StoreRequest $request): CommentResource
    {
        Gate::authorize('create', [Comment::class, $task]);
        $comment = Comment::query()
            ->create([
                'user_id' => auth()->user()->id,
                'task_id' => $task->id,
                'comment' => $request->comment
            ]);

        $taskExecutor = User::query()
            ->find($task->assigned_user_id);
        $taskExecutor->notify(new UserGotCommentOnTask($task));

        return new CommentResource($comment);
    }

    public function destroy(Comment $comment): void
    {
        Gate::authorize('delete', $comment);
        $comment->delete();
    }
}
