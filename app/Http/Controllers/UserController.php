<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page') ?? 50;
        $users = User::paginate($perPage);

        return UserResource::collection($users);
    }
}
