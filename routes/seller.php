<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Products\PostController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Categories\CategoriesController;


Route::middleware(['auth:api','IsSeller'])->group(function(){
    // Module User 

    Route::get('/users',[UserController::class,'getUsers']);
    Route::get('/users/filter',[UserController::class,'filterUsers']);

    // Module Products/Product

    Route::get('/products/categories', [PostController::class,'getCategories']);
    Route::post('/products', [ProductController::class,'store']);
    Route::post('/products/update', [ProductController::class,'update']);
    Route::delete('/products/delete', [ProductController::class,'delete']);
    Route::patch('/products/pause', [ProductController::class,'pause']);
    Route::patch('/products/active', [ProductController::class,'active']);
    Route::patch('/products/restore',[ProductController::class,'restore']);
    Route::get('/products', [ProductController::class,'getProductsByStatus']);
    Route::get('/products/filter', [ProductController::class,'filterProducts']);
   
    //Module Categories

    Route::post('/category/add',[CategoriesController::class,'add']);
    Route::get('/category/categories',[CategoriesController::class,'getCategories']);
    Route::get('/category/modules',[CategoriesController::class,'getModules']);
    Route::post('/category/edit',[CategoriesController::class,'update']);
    Route::post('/category/delete',[CategoriesController::class,'delete']);

    // Module Dashboard
    Route::get('/dashboard/quickStats', [DashboardController::class,'getQuickStats']);

// });
});