<?php

namespace App\Http\Controllers\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// REPOSITORIES
use App\Repositories\Product\ProductRepository;
// SERVICES
use App\Services\Products\Gallery; 
use App\Services\Files\DeleteFile;
use App\Services\ProductGallery\ProductGalleryService;
use App\Services\Products\ProductService;

// REQUETS
use App\Http\Requests\products\Post, App\Http\Requests\products\Update, App\Http\Requests\products\Delete, App\Http\Requests\products\FilterProducts;


class ProductController extends Controller
{

    public function __construct( ProductRepository $productRepositories){
        $this->productRepositories = $productRepositories;
    }

    public function getProductsByStatus(Request $request , ProductService $productService){
        return $productService->getProductsByStatus($request);
    }

    public function filterProducts(FilterProducts $request,ProductService $productService){
        return $productService->getProductsFilter($request);
    }

    public function store(Post $request,Gallery $gallery , ProductService $productService){
        return $productService->save($request,$gallery);   
    }

    public function update(Update $request,Gallery $gallery, DeleteFile $delete, ProductGalleryService $productGalleryService, ProductService $productService){
        //Si hay imagenes para eliminar
        $productGalleryService->delete($request,$delete);
        // actualizo el producto
        $productService->updateProduct($request);
        // si hay imagenes nuevas las guardo
        $productGalleryService->save($request, $gallery);
        // si hay un orden nuevo de imagenes las ordeno y guardo
        $productGalleryService->sortImages($request);
        return response()->json(['success' => 'Producto actualizado correctamente'],200);
                 
    }

    public function delete(Delete $request , ProductService $productService){
        return $productService->delete($request);
    }

    public function pause(Delete $request , ProductService $productService){
        return $productService->pause($request);
    }

    public function active(Delete $request, ProductService $productService){
        return $productService->active($request);
    
    }

    public function restore(Delete $request , ProductService $productService){
        return $productService->restore($request);
    }


}
