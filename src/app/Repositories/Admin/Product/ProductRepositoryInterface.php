<?php

namespace App\Repositories\Admin\Product;

use App\Http\Requests\RequestInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function all( string $orderBy ) :mixed;

    public function findBySlug(string $slug) : Product;

    public function store(RequestInterface $request): Product;

    public function update(RequestInterface $request, Model $product): void;

}
