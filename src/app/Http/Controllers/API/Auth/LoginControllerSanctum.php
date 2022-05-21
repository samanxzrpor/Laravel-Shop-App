<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\LoginReuqest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginControllerSanctum
{

    public function login(LoginReuqest $request)
    {
        $fields = $request->validated();

        $user = User::where('email' , $fields['email'])->first();

        if (!Auth::attempt($fields)) return response()->json([
            'message' => 'Invalid Credential'
        ], Response::HTTP_FORBIDDEN);

        $token = $user->createToken('karmaToken')->plainTextToken;

        return response()->json([
            'message' => 'Login Successfully' ,
            'token' => $token
        ] , Response::HTTP_OK);
    }
}
