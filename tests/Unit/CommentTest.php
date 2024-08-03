<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Comment;
use App\Models\Post;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_comment_can_be_created()
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'comment_body' => 'This is a test comment.'
        ]);

        $this->assertDatabaseHas('comments', [
            'comment_body' => 'This is a test comment.',
        ]);
    }
}
