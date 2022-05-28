<?php

namespace App\Repositories\Admin\Product;

use App\Http\Requests\RequestInterface;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function all() :Product;

    public function findBySlug(string $slug) : Product;

    public function store(RequestInterface $request): Product;

    public function update(RequestInterface $request, Model $product): void;

}
