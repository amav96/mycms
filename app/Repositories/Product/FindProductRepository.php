<?php 
namespace App\Repositories\Product;
use App\Http\Models\Product;

class FindProductRepository {

    private $model;
    
    public function __construct(){
        $this->model = new Product();
    }

    public function all($dataRequest){
        return $this->model::with('category')->with('gallery')->orderBy('id','desc')->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 3);
    }

    public function active($dataRequest){
        return $this->model::with('category')->with('gallery')
                                  ->where('status',1)
                                  ->orderBy('id','desc')
                                  ->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 3);
    }

    public function pause($dataRequest){
        return $this->model::with('category')->with('gallery')
                                  ->where('status',2)
                                  ->orderBy('id','desc')
                                  ->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 3);
    }

    public function outstock($dataRequest){
        return $this->model::with('category')
                                    ->with('gallery')
                                    ->where('inventory',0)
                                    ->orderBy('id','desc')->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 3);
    }

    public function eliminated($dataRequest){
        return $this->model::with('category')->with('gallery')
                                    ->onlyTrashed()->orderBy('id','desc')->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 3);
    }


}