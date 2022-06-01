<?php

namespace App\Repositories\Admin\User;

use App\Http\Requests\RequestInterface;
use App\Models\User;


interface UserRepositoryInterface
{
    public function all(string $orderBy);

    public function block(User $user);
}
