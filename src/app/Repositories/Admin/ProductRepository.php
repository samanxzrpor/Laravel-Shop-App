<?php

namespace App\Repositories\Admin;

use App\Http\Requests\RequestInterface;
use App\Models\Product;
use App\Repositories\RepositoriesInterface;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements RepositoriesInterface
{

    /**
     * @param mixed $request
     * @return void
     */
    public function store(mixed $request): void
    {
        $fields = $request->validated();

        Product::create([
            'title' => $fields['title'],
            'price' => $fields['price'],
            'count' => $fields['count'],
            'short_desc' => $fields['short_desc'],
            'description' => $fields['description'],
            'cat_id' => $fields['cat_id'],
            'user_id' => Auth::user()->id,
            'thumbnail_url' => '',
            'gallery_url' => '',
        ]);
    }

    public function find(RequestInterface $request): void
    {
        // TODO: Implement find() method.
    }

    public function update(RequestInterface $request): void
    {
        // TODO: Implement update() method.
    }

    public function delete(RequestInterface $request): void
    {
        // TODO: Implement delete() method.
    }
}
