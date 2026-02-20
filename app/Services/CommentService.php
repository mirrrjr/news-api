<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function getAll()
    {
        return Comment::orderBy("created_at", "desc")->get();
    }
    public function createComment(array $data)
    {
        // Logic to create a comment
        try {
            return Comment::create([
                "user_id" => auth()->id(),
                "post_id" => $data["post_id"],
                "content" => $data["content"],
            ]);
        } catch (\Throwable $e) {
            \Log::error('Comment yaratishda xatolik', [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    public function updateComment(int $id, array $data)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->update($data);
            return $comment;
        } catch (\Throwable $e) {

            \Log::error('Comment yangilashda xatolik', [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    public function deleteComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return true;
        } catch (\Throwable $th) {
            \Log::error('Comment o`chirishda xatolik', [
                'error' => $th->getMessage()
            ]);
            throw $th;
        }
    }
}