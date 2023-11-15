<?php

namespace App\Http\Controllers;

use App\Action\User\LoginUserAction;
use App\Action\User\LogoutUserAction;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(UserLoginRequest $request, LoginUserAction $action)
    {
        $user = $action->handle($request);

        if ($user){
            return successResponse($user);
        }
        return errorResponse();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function logout(Request $request, LogoutUserAction $action)
    {
        $userIsLoggedOut = $action->handle($request);

        if ($userIsLoggedOut){
            return successResponse([], 204);
        }
        return errorResponse();
    }
}
