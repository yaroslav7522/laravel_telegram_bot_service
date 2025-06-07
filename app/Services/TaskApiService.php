<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TaskApiService
{
    public function fetchData(): array
    {
        $response = Http::get('http://jsonplaceholder.typicode.com/todos');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Error task api request');
    }	
}