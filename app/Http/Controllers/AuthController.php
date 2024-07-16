<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $user = User::where('email', $request->email) 
            ->orWhere('username', $request->email)
            ->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => [ 'User with provided email/username does not exist' ],
            ]);
        }

        if (!md5($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => [ 'Provided password is incorrect' ],
            ]);
        }

        $apiToken = $user->createToken('test')->plainTextToken;

        return [
            'data' => [
                'api_token' => $apiToken,
                'user' => new UserResource($user),
            ],
        ];
    }

    public function userDetails(Request $request)
    {
        return new UserResource(auth()->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }


    public function registerAdmin(){
        $user = new User();
        $user->name = 'Admin2';
        $user->email = 'admin2@admin.com';
        $user->username = 'admin2';
        $user->password = md5('123456');
        $user->save();

        return response()->json([
            'message' => 'Admin created successfully',
        ]);
    }
}
