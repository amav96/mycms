<?php 
namespace App\Services\ProductGallery;
use App\Http\Models\ProductGallery;
use Illuminate\Support\Facades\Config;
// FACTORIES
use App\Factories\ProductsGallery\ProductGalleryFactory;
// REPOSITORIES
use App\Repositories\ProductGallery\ProductGalleryRepository;

class ProductGalleryService {

    private $model;
    private $productGalleryRepositories;
    private $productGalleryFactory;

    public function __construct(ProductGalleryRepository $productGalleryRepositories, ProductGalleryFactory $productGalleryFactory) {
        $this->model = new ProductGallery();
        $this->productGalleryRepositories = $productGalleryRepositories;
        $this->productGalleryFactory = $productGalleryFactory;
    }

    public function save($request, $gallery){
        // @ Entro aqui si hay imagenes que subir
        if($request->file('image')):
            foreach($request->file('image') as $index => $image){
                $productGalleryInstance = $this->productGalleryFactory->createOrderedGallery($image,$request,$gallery);
                $this->productGalleryRepositories->save($productGalleryInstance, $gallery,$image);
             } 
        endif;
    }

    public function delete($request,$delete){
        // @ Entra aqui solo si hay imagenes que borrar
        if(!$this->productGalleryRepositories->delete($request,$delete))
        return response()->json(['error' => 'No se borraron los imagenes correctamente'],500);
    }

    public function sortImages($request){

        $uploadPath = Config::get('filesystems.disks.uploads.root');
       
        // recorro lo que hay dentro del SORT y consulto en la DB por id_product, file_path,file_name y le actualizo la posicion que me llega
        foreach(json_decode($request->input('sort')) as $element){
            if($element->file_path){
                $product_id = $element->product_id;
                $file_path = explode('/',$element->file_path)[0];
                $file_name = explode('/',$element->file_path)[1];
                $position = $element->position;

                if(file_exists($uploadPath.'/'.$file_path.'/'.$file_name)){
                    $getPositionGallery = $this->model::where('product_id',$product_id)
                                                     ->where('file_path',$file_path)
                                                     ->where('file_name',$file_name)
                                                     ->update(['position' => $position]);
                    if($getPositionGallery) {$result = true;}
                    else{
                        $result = false; return response()->json(['error' => 'La imagen no existe. DB'],404);
                    }
                }else{
                    $result = false; return response()->json(['error' => 'El archivo no existe'],404);
                }
            
            }else{
                // si es falso es por que la imagen es nueva y todavia no tiene una ruta
                $result = true;
            }
        }
        return $result;
    }
   
}