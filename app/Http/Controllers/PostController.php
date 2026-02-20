<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService,
    ) {
    }

    public function index()
    {
        $posts = $this->postService->getPosts();

        return response()->json([
            'data' => $posts
        ]);
    }

    public function store(PostStoreRequest $request)
    {
        $post = $this->postService->createPost($request->validated());

        return response()->json([
            'data' => $post
        ], 201);
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $post = $this->postService->updatePost($post->id, $request->validated());

        return response()->json([
            'data' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post->id);

        return response()->json([
            'message' => 'Post muvaffaqiyatli o\'chirildi'
        ]);
    }

    public function getById(Post $post)
    {
        return response()->json([
            'data' => Post::with('comments.user')->find($post->id)
        ]);
    }
}
