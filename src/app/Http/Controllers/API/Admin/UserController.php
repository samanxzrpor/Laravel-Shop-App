<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Users\ChangeUserRoleRequest;
use App\Models\User;
use App\Repositories\Admin\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response ;
use Symfony\Component\HttpFoundation\Response as StatusResponse;


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

        return Response::json([
            'users' => $users,
        ] , StatusResponse::HTTP_OK);
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

        return Response::json([
            'message' => 'User deleted successfully',
        ] , StatusResponse::HTTP_OK);
    }


    public function blockUser(User $user)
    {
        $this->userRepository->block($user);

        return Response::json([
            'message' => 'User Blocked successfully',
        ] , StatusResponse::HTTP_OK);
    }


    public function changeUserRole(User $user , ChangeUserRoleRequest $request)
    {
        $this->userRepository->changeRole($user , $request);

        return Response::json([
            'message' => 'User Role Changed Successfully',
        ] , StatusResponse::HTTP_OK);
    }
}
