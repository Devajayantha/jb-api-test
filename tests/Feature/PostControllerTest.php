<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_store_posts(): void
    {
        $user = User::factory()->create();

        $token = $user->createToken($user->id)->plainTextToken;

        $post = Post::factory()->make();

        $payload = [
            'title' => $post->title,
            'content' => $post->content,
            'is_active' => $post->is_active,
        ];

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson(route('api.v1.posts.store'), $payload);

        $response->assertStatus(200);
    }
}
