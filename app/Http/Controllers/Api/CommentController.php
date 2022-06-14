<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function store(CreateRequest $request, CommentService $commentService): CommentResource
    {
        $comment = $commentService->createComment($request->validated());

        $commentService->updateCandidateStatus($comment);

        return new CommentResource($comment);
    }

    public function update(UpdateRequest $request, Comment $comment): CommentResource
    {
        $comment->update($request->validated());

        return new CommentResource($comment);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json([
            'message' => "Comment deleted."
        ]);
    }
}
