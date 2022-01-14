<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\categories\Save;
use App\Http\Requests\categories\Delete;
use Illuminate\Http\Request;
use App\Http\Models\Category;
use App\Http\Models\Module;
use Str,DB;

class CategoriesController extends Controller
{
    public function add(Save $request){

         $category = new Category();
         $category->module = $request->input('module');
         $category->name = e($request->input('name'));
         $category->slug = Str::slug($request->input('name'));
         $category->icon = e($request->input('icon'));

         if($category->save()){
             return response()->json(['success' => true],200);
         }else{
             return response()->json(['error' => true],200);
         }


    }

    public function update(Save $request){
        $category = Category::find($request->id);
        $category->module = $request->input('module');
        $category->name = $request->input('name');
        // $category->slug = Str::slug($request->input('name'));
        $category->icon = $request->input('icon');
        if($category->save()){
            return response()->json(['success' => true],200);
        }else{
            return response()->json(['error' => true],200);
        }
    }

    public function delete(delete $request){
        $category = Category::find($request->id);
        if($category->delete()){
            return response()->json(['success' => true],200);
        }else{
            return response()->json(['error' => true],200);
        }
    }

    public function getCategories(Request $request){
        $categories =  Category::Categories($request->module)
                                ->paginate(10);

        if(count($categories)>0){$data = $categories;}
        else {$data = ['error' => true];}
        return response()->json($data);
    }
    
    public function getModules(){

         $modules = Module::Modules()
                            ->get();

         if(count($modules)>0){
            foreach($modules as $element){
                $data[]=[
                    'id'    => $element->id,
                    'slug'  => $element->module
                ];
            }
         }else {$data = ['error' => true];}
          return response()->json($data);
         
        
    }
}
