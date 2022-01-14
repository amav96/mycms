<?php 

namespace App\Services\Images;
use Config,Image;
use Illuminate\Support\Str;

class Upload {

    public function nameImage($image){
        $fileExtension = trim($image->getClientOriginalExtension());
        $name = Str::slug(str_replace($fileExtension,'',$image->getClientOriginalName()));
        $filename = rand(1,999).'-'.$name.'.'.$fileExtension;
        return $filename;
    }

 
    public function uploadImage($image,$path,$filename,$disk,$mini = null){
        $save = false;
        //guardar la imagen original
        // folder o path, name , disk
    
        if($image->storeAs($path,$filename,$disk)){
            $save = true;
        }else{
            $save = false;
        }
       
        //imagen miniatura
        if($mini && $mini !== null){
             // La ruta para guardar que estoy usando
            $final_file = $this->uploadPath().'/'.$path.'/'.$filename;
            $imageMini = Image::make($final_file);
            $imageMini->resize(90, 90, function($constrain){
                $constrain->upsize();
            });
            $imageMini->save($this->uploadPath().'/'.$path.'/t_'.$filename);
            if($file && $imageMini){
                $save = true;
            }else{
                $save = false;
            }
        }
        
        return $save;

    }
}