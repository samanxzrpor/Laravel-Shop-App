<?php

namespace App\Repositories\Admin\Blog;

use App\Http\Requests\RequestInterface;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogRepository implements BlogRepositoryInterface
{


    public function store(RequestInterface $request): Model
    {
        $fields = $request->validated();

        return Blog::create([
            'title' => $fields['title'],
            'slug' => Str::slug($fields['title']),
            'body' => $fields['body'],
            'user_id' => Auth::user()->id,
        ]);
    }

    public function update(RequestInterface $request, Model $model): void
    {
        // TODO: Implement update() method.
    }
}
