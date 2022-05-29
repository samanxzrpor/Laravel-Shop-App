<?php

namespace App\Repositories\Admin\Blog;

use App\Http\Requests\RequestInterface;
use App\Models\Blog;

interface BlogRepositoryInterface
{
    public function store(RequestInterface $request): Blog;

    public function update(RequestInterface $request, Blog $blog): void;
}
