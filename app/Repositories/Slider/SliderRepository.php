<?php 
namespace App\Repositories\Slider;

use Illuminate\Support\Facades\Auth;
use App\Http\Models\Slider;

class SliderRepository {

    private $model;

    public function __construct(){
        $this->model = new Slider();   
    }

    public function save($request, $imagesService){

        $this->model->user_id = Auth::id();
         $this->model->status = 1;
         $this->model->name = $request->input('name');
         $this->model->file_path = date('Y-m-d');
         $this->model->file_name = $imagesService->nameImage($request->file('image'));
         $this->model->content = $request->input('content');
         $this->model->slider_order = $request->input('slider_order');
         if($this->model->save()){
              if($request->hasFile('image')){
                  $path = 'images/sliders/'.date('Y-m-d');
                  if($imagesService->uploadImage($request->image,$path,$imagesService->nameImage($request->image),'public')){
                      return response()->json(['success' => 'Slider creado correctamente'],200);
                  }else{
                      return response()->json(['error' => 'Slider no se creo correctamente'],200);
                  }
              }
          }else{
              return response()->json(['error' => 'No se guardo la informacion correctamente'],200);
          }
        
    }

}