<?php

namespace App\Repositories;

use App\Http\Requests\RequestInterface;
use Illuminate\Database\Eloquent\Model;

interface RepositoriesInterface
{

    public function store(RequestInterface $request) :Model ;
    public function find(RequestInterface $request) :void ;
    public function update(RequestInterface $request , Model $model) :void ;
    public function delete(Model $model) :void ;
}
