<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(
        private CommentService $commentService,
    ) {
    }

    public function index()
    {
        $comments = $this->commentService->getAll();

        return response()->json([
            'data' => $comments
        ]);
    }

    public function store(CommentStoreRequest $request)
    {
        $comment = $this->commentService->createComment($request->all());

        return response()->json([
            'data' => $comment
        ], 201);
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment = $this->commentService->updateComment($comment->id, $request->all());

        return response()->json([
            'data' => $comment
        ]);
    }

    public function destroy(Comment $comment)
    {
        $this->commentService->deleteComment($comment->id);

        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }

    public function getById(Comment $comment)
    {
        return response()->json([
            'data' => $comment
        ]);
    }
}