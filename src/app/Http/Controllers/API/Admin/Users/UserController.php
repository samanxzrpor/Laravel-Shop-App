<?php

namespace App\Http\Controllers\API\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Admin\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Response as StatusResponse;
use Symfony\Component\HttpFoundation\Response;



class UserController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of the Users in Admin Panel.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = $this->userRepository->all($this->setOrderBy());

        return StatusResponse::json([
            'users' => $users,
        ] , Response::HTTP_OK);
    }


    /**
     * Remove the specified User from Database.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return StatusResponse::json([
            'message' => 'User deleted successfully',
        ] , Response::HTTP_OK);
    }


    public function blockUser(User $user)
    {
        $this->userRepository->block($user);

        return StatusResponse::json([
            'message' => 'User Blocked successfully',
        ] , Response::HTTP_OK);
    }
}
