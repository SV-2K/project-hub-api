<?php

namespace App\Notifications;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUnassignedFromYourProject extends Notification
{
    use Queueable;

    public function __construct(
        private Project $project,
        private User $assignedUser
    )
    {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "User: {$this->assignedUser->name} was unassigned from your project: {$this->project->name}",
            'user_id' => $this->assignedUser->id,
            'project_id' => $this->project->id
        ];
    }
}
