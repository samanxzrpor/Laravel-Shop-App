<?php

namespace App\Repositories\Admin\Blog;

use App\Http\Requests\RequestInterface;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogRepository implements BlogRepositoryInterface
{


    public function store(RequestInterface $request): Blog
    {
        $fields = $request->validated();

        $blog = Blog::create([
            'title' => $fields['title'],
            'slug' => Str::slug($fields['title']),
            'body' => $fields['body'],
            'user_id' => Auth::user()->id,
        ]);

        $blog->categories()->sync($fields['cat_ids']);
        return $blog;
    }

    public function findBySlug(string $slug)
    {
        return Blog::where('slug', $slug)->first();
    }

    public function update(RequestInterface $request, Blog $blog): void
    {
        $fields = $request->validated();

        $blog->update([
            'title' => $fields['title'],
            'slug' => Str::slug($fields['title']),
            'body' => $fields['body'],
        ]);

        $blog->categories()->sync($fields['cat_ids']);
    }
}
