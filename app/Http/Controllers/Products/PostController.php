<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category;

class PostController extends Controller
{
    public function getCategories(Request $request){
        $categories = Category::Categories($request->id)
                                ->get();

        if(count($categories)>0){$data = $categories;}
        else {$data = ['error' => true];}
        return response()->json($data);

    } 
}