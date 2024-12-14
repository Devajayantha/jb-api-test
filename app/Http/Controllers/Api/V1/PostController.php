<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PostRequest;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use App\Services\V1\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostController extends Controller
{
    /**
     * Create a contructor for the controller.
     *
     * @param \App\Services\V1\PostService $service
     */
    public function __construct(protected PostService $service){}

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $request->validate([
            'limit' => ['sometimes', 'nullable', 'integer', 'min:1'],
            'search' => ['sometimes', 'nullable', 'string', 'min:2'],
        ]);

        $posts = $this->service->list($request);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $this->service->create($request->getPostData());

        return JsonResource::make([]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\PostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->service->update($post, $request->getPostData());

        return JsonResource::make([]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        return PostResource::make($post->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return JsonResource::make([]);
    }
}
