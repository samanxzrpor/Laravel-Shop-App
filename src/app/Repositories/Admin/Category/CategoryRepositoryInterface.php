<?php

namespace App\Repositories\Admin\Category;

use App\Http\Requests\RequestInterface;
use App\Models\Category;


interface CategoryRepositoryInterface
{
    public function all();

    public function store(RequestInterface $request): Category;

}
