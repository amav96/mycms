<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use App\Http\Requests\register\SaveUser;
use App\Http\Requests\register\ValidateCode;
use Illuminate\Http\Request;
use App\Services\Authenticate\RegisterService;

class RegisterController extends Controller 
{

    public function register(SaveUser $request, RegisterService $registerService){
        return $registerService->handlerRegister($request);
    }

    public function validateCode(ValidateCode $request , RegisterService $registerService){
        return $registerService->validateCode($request);
    }

    public function checkTokenRegister(Request $request , RegisterService $registerService){
        return $registerService->checkTokenRegister($request);
    }

}
