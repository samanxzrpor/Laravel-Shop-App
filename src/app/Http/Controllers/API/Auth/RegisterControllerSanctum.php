<?php
namespace App\Http\Controllers\API\Auth;



use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterControllerSanctum
{


    public function register(RegisterRequest $request)
    {
        $fields = $request->validated();

        $user = $this->storeUser($fields);

        $user->email === config('permission.super_admin_email') ?
            $user->assignRole('Super Admin') : $user->assignRole('User');

        return response()->json([
            'user' => $user ,
        ] , Response::HTTP_CREATED);
    }

    private function storeUser(array $fields)
    {
        return User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'number' => $fields['number'],
            'password' => Hash::make($fields['password'],)
        ]);
    }
}
