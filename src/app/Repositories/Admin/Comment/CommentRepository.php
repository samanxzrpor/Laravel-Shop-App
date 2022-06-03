<?php

namespace App\Repositories\Admin\Comment;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{

    public function all() :mixed
    {
        return Comment::orderByDesc('created_at')
            ->paginate(20);
    }


    public function block(Comment $comment): void
    {
        $block = $comment->block === 'no' ? 'yes' : 'no';
        $comment->update([
            'block' => $block
        ]);
    }

}
