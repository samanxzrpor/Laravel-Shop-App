<?php

namespace App\Http\Controllers\API\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Products\StoreProductRequest;
use App\Http\Requests\API\Admin\Products\UpdateProductRequest;
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
     * @return JsonResponse
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
     * @param  Product $product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        return Response::json([
            'product' => $product
        ] , StatusResponse::HTTP_OK);
    }

    /**
     * Update the specified Product in Database.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productRepository->update($request, $product);
    }

    /**
     * Remove the specified Product from Database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


}
