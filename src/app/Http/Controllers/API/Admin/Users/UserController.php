<?php

namespace App\Http\Controllers\API\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Response as StatusResponse;
use Symfony\Component\HttpFoundation\Response;



class UserController extends Controller
{

    /**
     * Display a listing of the Users in Admin Panel.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(20);

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
}
