<?php 

namespace App\Services\Products;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;

class Gallery {

    public function nameImage($image){
        $fileExtension = trim($image->getClientOriginalExtension());
        $name = Str::slug(str_replace($fileExtension,'',$image->getClientOriginalName()));
        $filename = rand(1,999).'-'.$name.'.'.$fileExtension;
        return $filename;
    }

    public function uploadPath() {
        $uploadPath = Config::get('filesystems.disks.uploads.root');
        return $uploadPath;
    }

    public function uploadImage($image,$path,$filename,$disk){
        $save = false;
        //guardar la imagen original
      
        $file = $image->storeAs($path,$filename,$disk);
        
        // La ruta para guardar que estoy usando
        $final_file = $this->uploadPath().'/'.$path.'/'.$filename;
        //imagen miniatura
        $imageMini = Image::make($final_file);
        $imageMini->resize(90, 90, function($constrain){
            $constrain->upsize();
        });
        $imageMini->save($this->uploadPath().'/'.$path.'/t_'.$filename);
        if($file && $imageMini){
            $save = true;
        }
        return $save;

    }
}