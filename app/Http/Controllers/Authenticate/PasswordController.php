<?php

namespace App\Http\Controllers\Authenticate;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\Password;
use Illuminate\Http\Request;


use App\Services\Authenticate\PasswordService;

class PasswordController extends Controller
{ 
    public function password_reset(Request $request,PasswordService $passwordService){
        return $passwordService->password_reset($request);
    }

    public function validateTokenToShowPasswordReset(Request $request ,PasswordService $passwordService){
        return $passwordService->validateTokenToShowPasswordReset($request);
    }

    public function restore_password(Password $request ,PasswordService $passwordService){
        return $passwordService->restore_password($request);
    }

}
