<?php 

namespace App\Services\Products;
use Illuminate\Support\Str;
use App\Http\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Factories\Products\PostProductFactory;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\FindProductRepository;
use App\Repositories\Product\FilterProductRepository;
use App\Factories\ProductsGallery\ProductGalleryFactory;
use App\Repositories\ProductGallery\ProductGalleryRepository;


class ProductService {

    private $postProductFactory;
    private $productGalleryFactory;
    private $productRepository;
    private $productGalleryRepository;
    private $findProductRepository;
    private $filterProductRepository;

    public function __construct(
        PostProductFactory                  $postProductFactory, 
        ProductGalleryFactory               $productGalleryFactory, 
        ProductRepository                   $productRepository,
        ProductGalleryRepository            $productGalleryRepository,
        FindProductRepository               $findProductRepository,
        FilterProductRepository             $filterProductRepository
        ) {
        $this->postProductFactory           = $postProductFactory;
        $this->productGalleryFactory        = $productGalleryFactory;
        $this->productRepository            = $productRepository;
        $this->productGalleryRepository     = $productGalleryRepository;
        $this->findProductRepository        = $findProductRepository;
        $this->filterProductRepository      = $filterProductRepository;
    }

    public function save($request,$gallery){

        $post = $this->postProductFactory->createInstance($request);
        if($post = $this->productRepository->save($post)):
            if($request->file('image')):
                foreach($request->file("image") as $index => $image){
                    $productGalleryFactoryInstance = $this->productGalleryFactory->createSaveGallery($post->id,$gallery, $index,$image);
                    if(!$this->productGalleryRepository->save($productGalleryFactoryInstance, $gallery, $image)):
                        return response()->json(['error' => 'No se creo correctamente'],500);
                    endif;
                }
            endif;
        endif;
        return response()->json(['success' => 'Creado correctamente'],200);

    }

    public function updateProduct($request){
        
        $product = $this->productRepository->get($request->id);
        $product->status = 1;
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
        $this->productRepository->save($product);

    }

    public function delete($request){

        $DeleteProduct = Product::find(e($request->id));
        
        if(is_null($DeleteProduct)):
            return response()->json(['error' => 'No se encontro ningún producto para eliminar'],404);
        endif;
            
        $DeleteProduct->id_user     =  Auth::user()->id;
            
        $this->productRepository->delete($DeleteProduct);
        return response()->json(['success' => 'Eliminado correctamente'],200);
    }

    public function pause($request){

        $pauseProduct = Product::find(e($request->id));
        
        if(is_null($pauseProduct)):
            return response()->json(['error' => 'No se encontro ningún producto para pausar'],404);
        endif;
            
        $pauseProduct->id_user     =  Auth::user()->id;
        $pauseProduct->status      = 2;
            
        $this->productRepository->save($pauseProduct);
        return response()->json(['success' => 'Pausado correctamente'],200);

    }

    public function active($request){

        $activeProduct = Product::find(e($request->id));
        
        if(is_null($activeProduct)):
            return response()->json(['error' => 'No se encontro ningún producto para activar'],404);
        endif;
            
        $activeProduct->id_user     =  Auth::user()->id;
        $activeProduct->status      = 1;
            
        $this->productRepository->save($activeProduct);
        return response()->json(['success' => 'Activado correctamente'],200);

    }

    public function restore($request){

        $restoreProduct = Product::where('id',e($request->id))->onlyTrashed()->first();
        
        if(is_null($restoreProduct)):
            return response()->json(['error' => 'No se encontro ningún producto para activar'],404);
        endif;
            
        $restoreProduct->id_user     =  Auth::user()->id;
        $restoreProduct->status      = 1;
        $this->productRepository->restore($restoreProduct);
        $this->productRepository->save($restoreProduct);

        return response()->json(['success' => 'Restaurado correctamente'],200);

    }

    public function getProductsByStatus($request){

        $dataRequest =  $request->dataRequest ?  json_decode($request->dataRequest,true) : false;
        $getProductsByStatus = $this->findProductRepository->{$dataRequest["status"]}($dataRequest);
        
        if(count($getProductsByStatus)>0){
            return response()->json($getProductsByStatus);
        }else{
            return response()->json(['error' => 'No hay productos para mostrar'],404);
        }
        
    }

    public function getProductsFilter($request){
       
        $dataRequest =  $request->dataRequest ?  json_decode($request->dataRequest,true) : false;
       
        if(!isset($dataRequest["filter"])):
            $getProductsFilter = $this->filterProductRepository->allWithOutFilter($dataRequest);
        else:
            $getProductsFilter = $this->filterProductRepository->{$dataRequest["status"]}($dataRequest);
        endif;
        
        if(count($getProductsFilter)>0){
            return response()->json($getProductsFilter);
        }else{
            return response()->json(['error' => 'No hay productos para mostrar'],404);
        }
      
    }

    
}