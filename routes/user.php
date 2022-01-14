<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::middleware(['auth:api','IsUserActive'])->group(function(){
        Route::patch('/account/update/password', [UserController::class,'updatePassword']);
        Route::patch('/account/update/phone', [UserController::class,'updatePhone']);
        Route::patch('/account/update/name', [UserController::class,'updateName']);
        Route::patch('/account/update/gender',  [UserController::class,'updateGender']);
        Route::patch('/account/update/birthday', [UserController::class,'updateBirthday']);
});