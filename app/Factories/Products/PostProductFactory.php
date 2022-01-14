<?php 
namespace App\Factories\Products;

use Illuminate\Support\Str;
use App\Http\Models\Product;
use Illuminate\Support\Facades\Auth;

class PostProductFactory {

    private $status;

    public function __construct(){
        $this->status = 1;
    }

    public function createInstance($request , $id = null)
    {
       
        $product = new Product();
        $product->status = $this->status;
        $product->code = e($request->input("code"));
        $product->id_user = Auth::user()->id;
        $product->name = e($request->input("name"));
        $product->slug = Str::slug($request->input("name"));
        $product->category_id = $request->input("category");
        $product->price = $request->input("price");
        $product->inventory = e($request->input("inventory"));
        $product->in_discount = $request->input("in_discount");
        $product->discount = $request->input("discount");
        $product->content = e($request->input("content"));
        

        return $product;
    }
}