<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Models\User,App\Http\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function getQuickStats(){

        $Users = User::count();
        $Products = Product::where('status',1)->count();
        $collection = collect(([
            'users' =>  $Users,
            'products' =>  $Products
        ]));
        return $collection;

    }
    
}
