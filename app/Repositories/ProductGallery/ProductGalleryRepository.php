<?php 
namespace App\Repositories\ProductGallery;
use App\Http\Models\ProductGallery;
use Illuminate\Support\Facades\Config;

class ProductGalleryRepository{

    private $model;
    private $root;

    public function __construct(){
        $this->model = new ProductGallery();
        $this->root = Config::get('filesystems.disks.uploads.root');
    }

    public function save(ProductGallery $productGallery, $gallery ,$image ){
       
        if(!$productGallery->save()) return response()->json(['error' => 'No se guardo la galeria de imagenes correctamente'],500);
        if(!$gallery->uploadImage($image,"/".date('Y-m-d'),$productGallery->file_name,'uploads')){
            return response()->json(['error' => 'No se guardo correctamente el archivo de imagenes'],500);
        }
        return true;
    }

    public function delete($request,$delete){
        
        $result = true;
        $imagesToDelete = json_decode($request->input('deletedImagesServer'));
        if($imagesToDelete && count($imagesToDelete) > 0){

            foreach($imagesToDelete as $element){
                $file_path = $this->root.'/'.$element->file_path.'/'.$element->file_name;
                $file_path_miniature = $this->root.'/'.$element->file_path.'/t_'.$element->file_name;

                 $DeleteProductGallery = $this->model::where('product_id',e($request->input('id')))
                 ->where('file_path',$element->file_path)
                 ->where('file_name',$element->file_name)->first();
                  if($DeleteProductGallery){
                      if($DeleteProductGallery->delete()){
                           if($delete->removeFile($file_path) && $delete->removeFile($file_path_miniature)){
                                 $result = true;
                                 }else{$result = false;}
                        }
                      else{$result = false;}
                  }else{$result = false;}
           };
        }

        return $result;
    }


}