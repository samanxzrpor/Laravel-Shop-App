<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;

class BlogsController extends Controller
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


    public function show(Blog $blog)
    {
        $views = Redis::incr($blog->id . '|' . 'view');


        return Response::json([
            'product' => $blog ,
            'visits' => $views
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
