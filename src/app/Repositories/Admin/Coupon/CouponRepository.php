<?php

namespace App\Repositories\Admin\Coupon;


use App\Http\Requests\RequestInterface;
use App\Models\Coupon;
use Illuminate\Support\Str;

class CouponRepository implements CouponRepositoryInterface
{


    public function all() :mixed
    {
        return Coupon::orderByDesc('created_at')
            ->paginate(20);
    }


    public function makeCoupon(RequestInterface $request) :Coupon
    {
        $coupon = $request->validated();

        $coupon = Coupon::create([
            'coupon_code' => $coupon['coupon_code'],
            'expire_at' => $coupon['expire_at'],
        ]);

        if ($coupon['pro_ids'])
            $coupon->products->sync($coupon['pro_ids']);

        return $coupon;
    }
}
