<?php

namespace App\Actions;

use App\Services\TaskApiService;
use App\Repositories\TaskRepository;

class SyncTaskData
{
    public function __construct(
        protected TaskApiService $apiService,
        protected TaskRepository $taskRepository
    ) {}

    public function handle(): void
    {
        $tasks = $this->apiService->fetchData();

        foreach ($tasks as $td) {
            $data = [
                'id' 		=> $td['id'],
                'user_id' 	=> $td['userId'],
                'completed' => $td['completed'],
                'title' 	=> $td['title'],
            ];

            $this->taskRepository->createOrUpdate($data);
        }
    }
}