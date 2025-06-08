<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function create(int $projectId, array $data): Task
    {
        $task = Task::query()
            ->create([
                'project_id' => $projectId,
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'priority' => $data['priority'],
                'deadline' => $data['deadline'],
                'assigned_user_id' => $data['assigned_user_id']
            ]);
        return $task;
    }
}
