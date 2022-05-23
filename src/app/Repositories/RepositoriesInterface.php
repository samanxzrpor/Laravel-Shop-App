<?php

namespace App\Repositories;

use App\Http\Requests\RequestInterface;

interface RepositoriesInterface
{

    public function store(RequestInterface $request) :void ;
    public function find(RequestInterface $request) :void ;
    public function update(RequestInterface $request) :void ;
    public function delete(RequestInterface $request) :void ;
}
