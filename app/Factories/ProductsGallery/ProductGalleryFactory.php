<?php
namespace App\Factories\ProductsGallery;

use App\Http\Models\ProductGallery;


class ProductGalleryFactory{

    private $file_name;

    public function createSaveGallery(int $id,$gallery,$index,$image){

            $ProductGallery = new ProductGallery();
            $ProductGallery->product_id = $id;
            $ProductGallery->file_path = date('Y-m-d');
            $ProductGallery->position = $index;
            $this->file_name = $gallery->nameImage($image);
            $ProductGallery->file_name =$this->file_name;
            return $ProductGallery;

    }

    public function createOrderedGallery($image,$request,$gallery){

        $originalName = $image->getClientOriginalName();
        foreach(json_decode($request->input('sort')) as $element){
              if($element->name === $originalName){
                  $ProductGallery = new ProductGallery();
                  $ProductGallery->product_id = $request->id;
                  $ProductGallery->file_path = date('Y-m-d');
                  $ProductGallery->position = $element->position;
                  $file_name = $gallery->nameImage($image);
                  $ProductGallery->file_name = $file_name;
              }
        }

      
        return $ProductGallery;
    }

  

}