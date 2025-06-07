<?php

namespace Database\Seeders;

use App\Models\Task;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory(10)->create();
        /*Task::factory()->create([
            'id' => 1,
            'user_id' => 1,
            'title' => 'Test task #1',
            'completed' => 0,
        ]);*/		
    }
}
