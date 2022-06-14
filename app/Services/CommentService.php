<?php

namespace App\Services;

use App\Exceptions\StatusAlreadyExistsException;
use App\Exceptions\StatusSkippedException;
use App\Models\Comment;
use App\Models\Status;

class CommentService
{
    /**
     * @throws \Throwable
     */
    public function createComment(array $commentData): Comment
    {
        throw_if(
            $this->commentExists(
                $commentData['candidate_id'],
                $commentData['status_id']
            ),
            StatusAlreadyExistsException::class
        );

        throw_if(
            $this->statusSkipped(
                $commentData['candidate_id'],
                $commentData['status_id']
            ),
            StatusSkippedException::class
        );

        return Comment::create($commentData);
    }

    public function updateCandidateStatus(Comment $comment): void
    {
        $comment->candidate()->update([
            'status' => $comment->status->name
        ]);
    }

    protected function commentExists(int $candidateId, int $statusId): bool
    {
        $existingComment = Comment::query()
            ->where('candidate_id', $candidateId)
            ->where('status_id', $statusId)
            ->get();

        return $existingComment->isNotEmpty();
    }

    protected function statusSkipped(int $candidateId, int $statusId): bool
    {
        if ($statusId == Status::FIRST_CONTACT) {
            return false;
        }

        $lastStatus = Comment::query()
            ->where('candidate_id', $candidateId)
            ->latest('id')
            ->first();

        return !$lastStatus || $statusId >= $lastStatus->status_id + 2;
    }
}
