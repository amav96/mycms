<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticate\PasswordController;
use App\Http\Controllers\Authenticate\RegisterController;
use App\Http\Controllers\Authenticate\AuthenticateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//AUTHENTICATE

    Route::post('login',[AuthenticateController::class,'login']);
    Route::post('checkToken', [AuthenticateController::class,'checkToken']);
    Route::post('logout', [AuthenticateController::class,'logout']);
    Route::post('password_reset',[AuthenticateController::class,'password_reset']);
    Route::post('admin', [AuthenticateController::class,'index']);

//RESTORE PASS 

    Route::post('password_reset',[PasswordController::class,'password_reset']);
    Route::get('token_reset_pass/{token_validate}',[PasswordController::class,'validateTokenToShowPasswordReset']);
    Route::post('restore_password',[PasswordController::class,'restore_password']);

//REGISTER

    Route::post('register', [RegisterController::class,'register']);
    Route::get('validateCode',[RegisterController::class,'validateCode']);
    Route::get('checkTokenRegister/{token_validate}',[RegisterController::class,'checkTokenRegister']);
    

