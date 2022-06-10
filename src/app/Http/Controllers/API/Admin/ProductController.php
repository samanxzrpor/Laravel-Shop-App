<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Products\StoreProductRequest;
use App\Http\Requests\API\Admin\Products\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Admin\Product\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;


class ProductController extends Controller
{

    private ProductRepositoryInterface $productRepository;


    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the Products.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = $this->productRepository->all($this->setOrderBy());

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
        $product = $this->productRepository->find($product);

        return Response::json([
            'product' => $product
        ] , StatusResponse::HTTP_OK);
    }

    /**
     * Update the specified Product in Database.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productRepository->update($request, $product);

        return Response::json([
            'message' => 'Product updated successfully'
        ] , StatusResponse::HTTP_OK);
    }

    /**
     * Remove the specified Product from Database.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return Response::json([
            'message' => 'Product deleted successfully'
        ] , StatusResponse::HTTP_OK);
    }


}
