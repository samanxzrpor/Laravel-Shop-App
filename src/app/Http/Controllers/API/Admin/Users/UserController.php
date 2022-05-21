<?php

namespace App\Http\Controllers\API\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the Users in Admin Panel.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(20);

        return response()->json([
            'users' => $users,
        ] , Response::HTTP_OK);
    }


    /**
     * Remove the specified User from Database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ] , Response::HTTP_OK);
    }
}
