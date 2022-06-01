<?php

namespace App\Repositories\Admin\Order;

use App\Http\Requests\RequestInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function all(string $orderBy = 'created_at')
    {
        return Order::orderByDesc($orderBy)
            ->paginate(20);
    }

}
