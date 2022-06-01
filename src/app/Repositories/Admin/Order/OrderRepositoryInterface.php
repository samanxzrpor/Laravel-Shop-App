<?php

namespace App\Repositories\Admin\Order;

use App\Http\Requests\RequestInterface;


interface OrderRepositoryInterface
{
    public function all(string $orderBy);

}
