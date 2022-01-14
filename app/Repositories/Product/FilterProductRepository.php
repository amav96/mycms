<?php 
namespace App\Repositories\Product;
use App\Http\Models\Product;
use App\Http\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class FilterProductRepository {

    private $model;
    
    public function __construct(){
        $this->model = new Product();
    }

    
    public function allWithOutFilter($dataRequest){

        return Product::selectRaw("*")
                    ->with('category')->with('gallery')
                    ->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 10);

    }

    public function all($dataRequest){

        
         return Product::selectRaw("*,match(name, content, slug) against('(".$dataRequest["filter"]."*) (".$dataRequest["filter"].")' IN BOOLEAN MODE) as relevance")->with('category')->with('gallery')
                    ->whereRaw("match(name, content, slug) against('(".$dataRequest["filter"]."*) (".$dataRequest["filter"].")' IN BOOLEAN MODE)")
                    ->orWhereHas('category', function (Builder $query) {
                        $query->where('name', 'like', '%'.request('filter').'%');
                    })
                    ->orderByRaw('relevance DESC')
                    ->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 10);
    }

    public function active($dataRequest){
        return Product::selectRaw("*,match(name, content, slug) against('(".$dataRequest["filter"]."*) (".$dataRequest["filter"].")' IN BOOLEAN MODE) as    relevance")->with('category')->with('gallery')
                    ->where(function($query){
                        $query->whereRaw("match(name, content, slug) against('(".request('filter')."*) (".request('filter').")' IN BOOLEAN MODE)")
                        ->orWhereHas('category', function (Builder $query) {
                            $query->where('name', 'like', '%'.request('filter').'%');
                        });
                    })
                    ->where(function($query){
                        $query->where('status',1);
                        })      
            ->orderByRaw('relevance DESC')
            ->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 10);
    }

    public function pause($dataRequest){
        return Product::selectRaw("*,match(name, content, slug) against('(".$dataRequest["filter"]."*) (".$dataRequest["filter"].")' IN BOOLEAN MODE) as relevance")->with('category')->with('gallery')
                    ->where(function($query){
                        $query->whereRaw("match(name, content, slug) against('(".request('filter')."*) (".request('filter').")' IN BOOLEAN MODE)")
                        ->orWhereHas('category', function (Builder $query) {
                            $query->where('name', 'like', '%'.request('filter').'%');
                        });
                    })
                    ->where(function($query){
                        $query->where('status',2);
                        })   
                    ->orderByRaw('relevance DESC')
                    ->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 10);
    }

    public function outstock($dataRequest){
        return Product::selectRaw("*,match(name, content, slug) against('(".$dataRequest["filter"]."*) (".$dataRequest["filter"].")' IN BOOLEAN MODE) as relevance")->with('category')->with('gallery')
                    ->where(function($query){
                        $query->whereRaw("match(name, content, slug) against('(".request('filter')."*) (".request('filter').")' IN BOOLEAN MODE)")
                        ->orWhereHas('category', function (Builder $query) {
                            $query->where('name', 'like', '%'.request('filter').'%');
                        });
                    })
                    ->where(function($query){
                        $query->where('inventory',0);
                        }) 
                    ->orderByRaw('relevance DESC')
                    ->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 10);
    }

    public function eliminated($dataRequest){

        return Product::selectRaw("*,match(name, content, slug) against('(".$dataRequest["filter"]."*) (".$dataRequest["filter"].")' IN BOOLEAN MODE) as relevance")->with('category')->with('gallery')
                    
                    ->where(function($query){
                        $query->whereRaw("match(name, content, slug) against('(".request('filter')."*) (".request('filter').")' IN BOOLEAN MODE)")
                        ->orWhereHas('category', function (Builder $query) {
                            $query->where('name', 'like', '%'.request('filter').'%');
                        });
                    })
                    ->onlyTrashed()
                    ->orderByRaw('relevance DESC')
                    ->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 10);
    }


}