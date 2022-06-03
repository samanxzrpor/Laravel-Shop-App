<?php

namespace App\Repositories\Admin\Coupon;

use App\Http\Requests\RequestInterface;
use App\Models\Coupon;

interface CouponRepositoryInterface
{
    public function all() :mixed;

    public function makeCoupon(RequestInterface $request) :Coupon;
}
