<?php

namespace App\Repositories\Admin\Comment;

use App\Http\Requests\RequestInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{

    public function all()
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
