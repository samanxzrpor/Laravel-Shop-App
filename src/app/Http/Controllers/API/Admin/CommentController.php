<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Repositories\Admin\Comment\CommentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;


class CommentController extends Controller
{

    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {

        $this->commentRepository = $commentRepository;
    }


    /**
     * Display a listing of the Comments in Panel.
     * @return JsonResponse
     */
    public function index()
    {
        $comments = $this->commentRepository->all();

        return Response::json([
            'comments' => $comments
        ] , StatusResponse::HTTP_OK);
    }


    /**
     * Display the specified Comment.
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function show(Comment $comment)
    {
        return Response::json([
            'comments' => $comment
        ] , StatusResponse::HTTP_OK);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return Response::json([
            'message' => 'Comment deleted successfully'
        ] , StatusResponse::HTTP_OK);
    }


    /**
     * @param Comment $comment
     * @return JsonResponse
     */
    public function blockComment(Comment $comment)
    {
        $this->commentRepository->block($comment);

        return Response::json([
            'message' => 'Comment Blocked successfully'
        ] , StatusResponse::HTTP_OK);
    }
}
