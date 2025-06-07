<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function createOrUpdate(array $data): Task
    {
        return Task::updateOrCreate(
            ['id' => $data['id']],
            $data
        );
    }
}