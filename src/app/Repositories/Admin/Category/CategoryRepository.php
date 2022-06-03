<?php

namespace App\Repositories\Admin\Category;

use App\Http\Requests\RequestInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function all() :mixed
    {
        return Category::orderByDesc('created_at')
            ->paginate(20);
    }


    public function store(RequestInterface $request): Category
    {
        $fields = $request->validated();

        return Category::create([
            'title' => $fields['title']
        ]);
    }
}
