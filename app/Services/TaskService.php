<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\UserAssignToTask;
use App\Repositories\UserRepository;

class TaskService
{
    public function __construct(
        private UserRepository $repository
    )
    {}

    public function create(int $projectId, array $data): Task|array
    {
        $assignedUser = User::find($data['assigned_user_id']);
        $project = Project::find($projectId);
        $userRole = $this->repository->getRole($assignedUser, $project);

        if (
            $assignedUser->id === $project->user_id
            || $userRole === 'manager'
            || $userRole === 'executor'
        ) {
            $task = Task::query()
                ->create([
                    'project_id' => $project->id,
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'status' => $data['status'],
                    'priority' => $data['priority'],
                    'deadline' => $data['deadline'],
                    'assigned_user_id' => $assignedUser->id
                ]);

            $assignedUser->notify(new UserAssignToTask($task));

            return $task;
        }
        return [
            'message' => 'User must be assigned to the project'
        ];
    }
}
