<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as StatusResponse;

class ProductsController extends Controller
{

    public function index()
    {


        return Response::json([

        ] , StatusResponse::HTTP_OK);
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Product $product)
    {
        $visits = Redis::incr($product->id . '|' . 'views');

        return Response::json([
            'product' => $product ,
            'visits' =>  $visits
        ] , StatusResponse::HTTP_OK);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
