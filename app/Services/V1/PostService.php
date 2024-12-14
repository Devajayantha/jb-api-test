<?php

namespace App\Services\V1;

use App\Models\Post;
use App\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostService
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list(Request $request): \Illuminate\Pagination\LengthAwarePaginator
    {
        $posts = Post::with('user:id,name')
            ->active()
            ->filter($request)
            ->latest()
            ->paginate($request->input('limit', 10));

        return $posts;
    }

    /**
     * Create a new post from spesific data.
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        DB::transaction(function () use ($data) {
            $post = new Post($data);

            $post->user()->associate(Auth::user());

            $post->save();
        });
    }

    /**
     * Update the specified post from spesific data.
     *
     * @param \App\Models\Post $post
     * @param array $data
     * @return void
     */
    public function update(Post $post, array $data)
    {
        DB::transaction(function () use ($post, $data) {
            $post->fill($data);

            $post->save();
        });
    }

    /**
     * Delete the specified post.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function delete(Post $post)
    {
        $post->deleteOrFail();
    }
}
