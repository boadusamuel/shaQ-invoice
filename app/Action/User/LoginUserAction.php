<?php

namespace App\Action\User;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use Exception;

class LoginUserAction
{
    function handle(UserLoginRequest $request): ?array
    {
        try {
            if (auth('api')->attempt($request->only('email', 'password'))) {
                $user = auth('api')->user();
                $token = $user->createToken('authToken')->plainTextToken;

                return ['token' => $token, 'user' => new UserResource($user)];
            }
        }catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
