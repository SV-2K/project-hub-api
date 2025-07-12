<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAssignToTask extends Notification
{
    use Queueable;
    public function __construct(
        private Task $task
    )
    {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "You've been assigned to the task: {$this->task->title}",
            'task_id' => $this->task->id
        ];
    }
}
