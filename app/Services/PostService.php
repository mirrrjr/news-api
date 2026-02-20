<?php

namespace App\Services;

use App\Models\Post;

class PostService
{

    public function getPosts()
    {
        $posts = Post::with('comments.user')->orderBy("created_at", "desc")->get();
        return $posts;
    }

    public function createPost(array $data): Post
    {
        try {
            return Post::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'user_id' => auth()->id(),
            ]);
        } catch (\Throwable $e) {

            \Log::error('Post yaratishda xatolik', [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    public function updatePost($id, $data)
    {
        try {
            $post = Post::findOrFail($id);
            $post->update($data);
            return $post;
        } catch (\Throwable $e) {

            \Log::error('Post yangilashda xatolik', [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    public function deletePost($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return true;
        } catch (\Throwable $e) {

            \Log::error('Post o`chirishda xatolik', [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }
}