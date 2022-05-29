<?php

namespace App\Http\Controllers\API\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Categories\StoreCategoryRequest;
use App\Models\Category;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;


class CategoryController extends Controller
{

    private CategoryRepositoryInterface $categoryRepository;


    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the Blogs.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return Response::json([
            'categories' => $categories,
        ] , StatusResponse::HTTP_OK);
    }


    /**
     * Store a newly created Blog in Database.
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->store($request);

        return Response::json([
            'category' => $category,
        ] , StatusResponse::HTTP_CREATED);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return Response::json([
            'message' => 'Category deleted successfully'
        ] , StatusResponse::HTTP_OK);
    }
}
