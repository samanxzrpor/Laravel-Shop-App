<?php

namespace App\Http\Controllers\API\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Products\StoreProductRequest;
use App\Models\Product;
use App\Repositories\RepositoriesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response as StatusResponse;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{

    private RepositoriesInterface $productRepository;

    public function __construct(RepositoriesInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the Products.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = Product::orderByDesc('created_at')->paginate(20);

        return Response::json([
            'products' => $products
        ] , StatusResponse::HTTP_OK);
    }

    /**
     * Store a newly created Product in Database.
     *
     * @param  StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        # Store Product Data and files in Database
        $product = $this->productRepository->store($request);

        return Response::json([
            'product' => $product
        ] , StatusResponse::HTTP_CREATED);
    }

    /**
     * Display the specified Product Data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


}
