<?php

namespace App\Repositories\Admin\Comment;

use App\Models\Comment;


interface CommentRepositoryInterface
{
    public function all();

    public function block(Comment $comment): void;

}
