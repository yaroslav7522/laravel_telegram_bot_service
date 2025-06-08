<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
	use DatabaseMigrations;
	 
    public function test_tasks_get(): void
    {
        $response = $this->get('/api/tasks');

        $response->assertStatus(200)->assertJsonCount(231)->assertJsonStructure([
                     '' => ['id', 'user_id', 'title', 'completed']
                 ]);;
    }
}
