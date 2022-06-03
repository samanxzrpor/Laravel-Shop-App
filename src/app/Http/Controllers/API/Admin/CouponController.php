<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Coupons\StoreCoupomRequest;
use App\Models\Coupon;
use App\Repositories\Admin\Coupon\CouponRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;

class CouponController extends Controller
{

    private CouponRepositoryInterface $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }


    public function index(): JsonResponse
    {
        $coupons = $this->couponRepository->all();

        return Response::json([
            'coupons' => $coupons
        ] , StatusResponse::HTTP_OK);
    }


    public function store(StoreCoupomRequest $request): JsonResponse
    {
        $coupon = $this->couponRepository->makeCoupon($request);

        return Response::json([
            'coupon' => $coupon
        ] , StatusResponse::HTTP_CREATED);
    }


    public function destroy(Coupon $coupon): JsonResponse
    {
        $coupon->delete();

        return Response::json([
            'message' => 'Coupon deleted successfully',
        ] , StatusResponse::HTTP_OK);
    }

}
