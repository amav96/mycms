<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Slider\SliderController;

Route::middleware(['auth:api','IsAdmin'])->group(function(){
        //USER

        Route::get('/user/updateUser', [UserController::class,'updateUser']);

        //SLIDER

        Route::post('/slider', [SliderController::class,'store']);

});