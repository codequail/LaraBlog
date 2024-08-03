<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_created()
    {
        $post = Post::factory()->create([
            'title' => 'Test Post',
            'body' => 'This is a test post.',
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'body' => 'This is a test post.',
        ]);
    }
}
