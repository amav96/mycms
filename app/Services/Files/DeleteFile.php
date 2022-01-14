<?php 


namespace App\Services\Files;

class DeleteFile {

    public function removeFile($file_path){
       
         if(file_exists($file_path)){
              if(unlink($file_path)){$result = true;}
              else{$result = false;}
         }else{
             $result = false;
         }

        return $result;
        
    }
}