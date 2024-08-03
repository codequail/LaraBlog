<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class PostCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->post('/api/posts', [
            'title' => 'New Post',
            'body' => 'Content of the new post.',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['data' => ['title' => 'New Post']]);
    }
}
