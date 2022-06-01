<?php

namespace App\Http\Controllers\API\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\UserRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;

class OrderController extends Controller
{

    private UserRepositoryInterface $orderRepository;

    public function __construct(UserRepositoryInterface $orderRepository)
    {

        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->all($this->setOrderBy());

        return Response::json([
            'orders' => $orders
        ] , StatusResponse::HTTP_OK);
    }


}
