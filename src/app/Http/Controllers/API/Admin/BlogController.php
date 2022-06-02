<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Blogs\StoreBlogRequest;
use App\Http\Requests\API\Admin\Blogs\UpdateBlogRequest;
use App\Models\Blog;
use App\Repositories\Admin\Blog\BlogRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;


class BlogController extends Controller
{

    private BlogRepositoryInterface $blogRepository;


    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }


    /**
     * Display a listing of the Blogs.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $blogs = $this->blogRepository->all($this->setOrderBy());

        return Response::json([
            'blogs' => $blogs,
        ] , StatusResponse::HTTP_OK);
    }


    /**
     * Store a newly created Blog in Database.
     *
     * @param StoreBlogRequest $request
     * @return JsonResponse
     */
    public function store(StoreBlogRequest $request)
    {
        $blog = $this->blogRepository->store($request);

        return Response::json([
            'blog' => $blog,
        ] , StatusResponse::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     *
     * @param Blog $blog
     * @return JsonResponse
     */
    public function show(Blog $blog): JsonResponse
    {
        $blog = $this->blogRepository->findBySlug($blog->slug);

        return Response::json([
            'blog' => $blog,
        ] , StatusResponse::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBlogRequest $request
     * @param Blog $blog
     * @return JsonResponse
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $this->blogRepository->update($request , $blog);

        return Response::json([
            'message' => 'Blog updated successfully' ,
        ] , StatusResponse::HTTP_OK);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     * @return JsonResponse
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return Response::json([
            'message' => 'Blog deleted successfully'
        ] , StatusResponse::HTTP_OK);
    }

}
