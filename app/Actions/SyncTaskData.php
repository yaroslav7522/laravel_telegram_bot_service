<?php

namespace App\Actions;

use App\Services\TaskApiService;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
//use App\Bot\TelegramApi;
use App\Jobs\SendTelegramMessage;

class SyncTaskData
{
    public function __construct(
        protected TaskApiService $apiService,
        protected TaskRepository $taskRepository,
        protected UserRepository $userRepository,
        //protected TelegramApi $telegram
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
	
	public function messages(): void
    {
		$users = $this->userRepository->getSubscribed();
		foreach($users as $user){
			if($user['id'] > 5) continue;
			$tasks = $this->taskRepository->getActiveByUser($user['id']);
			foreach($tasks as $task){
				//$this->telegram->sendMessage([
				//	'chat_id' => $user['telegram_id'],
				//	'text' => 'Завдання #'.$task['id'].': '.$task['title'],
				//]);	
				SendTelegramMessage::dispatch($user['telegram_id'], 'Завдання #'.$task['id'].': '.$task['title']);
			}
		}
	}
}