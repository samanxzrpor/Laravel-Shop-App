<?php

namespace App\Http\Controllers\API\Admin\Blogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Blogs\StoreBlogRequest;
use App\Models\Blog;
use App\Repositories\Admin\Blog\BlogRepositoryInterface;
use App\Repositories\RepositoriesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $blogs = Blog::orderByDesc('created_at')->paginate(20);

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
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
