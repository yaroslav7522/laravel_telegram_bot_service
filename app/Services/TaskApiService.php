<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\TaskRepository;

class TaskApiService
{
	public function __construct(protected TaskRepository $tasksRepository) {}
	
    public function fetchData(): array
    {
        $response = Http::get('http://jsonplaceholder.typicode.com/todos');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Error task api request');
    }

    public function getAll()
    {
        return $this->tasksRepository->all();
    }
	
    public function getById($id)
    {
        return $this->tasksRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->tasksRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->tasksRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->tasksRepository->delete($id);
    }	
	
}