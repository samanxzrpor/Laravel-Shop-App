<?php

namespace App\Repositories\Admin\Order;

use App\Http\Requests\RequestInterface;
use App\Models\Order;
use App\Models\Product;

class OrderRepository implements OrderRepositoryInterface
{

    public function all(string $orderBy = 'created_at') :mixed
    {
        return Order::with(['orderItems' => function ($query) {
                $query->orderByDesc(
                    Product::select('price')
                        ->whereColumn('pro_id' , 'products.id')
                        ->orderBy('price' , 'ASC')
                )->get();
            }])
            ->orderByDesc($orderBy)
            ->paginate(20);
    }

}
