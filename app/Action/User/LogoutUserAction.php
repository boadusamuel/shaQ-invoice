<?php

namespace App\Action\User;

use Exception;
use Illuminate\Http\Request;

class LogoutUserAction
{
    public function handle(Request $request): ?bool
    {
        try {
            $user = $request->user();
            if($user){
                $user->tokens()->delete();
                auth('api')->logout();

                return true;
            }
        } catch (Exception $exception) {
            report($exception);
        }
        return null;
    }
}
