<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUnassignedFromProject extends Notification
{
    use Queueable;

    public function __construct(
        private Project $project
    )
    {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "You've been unassigned from the project: {$this->project->name}",
            'project_id' => $this->project->id
        ];
    }
}
