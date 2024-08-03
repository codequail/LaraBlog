<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class CommentCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user, 'api')->post("/api/posts/{$post->id}/comments", [
            'comment_body' => 'This is a test comment.',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['data' => ['comment_body' => 'This is a test comment.']]);
    }
}
