<?php

namespace App\Repositories\Admin\Blog;

use App\Http\Requests\RequestInterface;
use Illuminate\Database\Eloquent\Model;

interface BlogRepositoryInterface
{
    public function store(RequestInterface $request): Model;

    public function update(RequestInterface $request, Model $model): void;
}
