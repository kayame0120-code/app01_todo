<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;


class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_tasks_can_be_listed(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }
    public function test_tasks_can_be_created(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/tasks', [
            'content' => 'テストタスク',
        ]);

        $response->assertRedirect();
    }
    public function test_tasks_can_be_updated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);


        $task = Task::factory()->create();
        $response = $this->put("/tasks/{$task->id}", 
        [
            'content' => '更新されたタスク',
        ]);

        $response->assertRedirect();
    }
    public function test_tasks_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();
        $response = $this->delete("/tasks/{$task->id}");

        $response->assertRedirect();
    }
}
