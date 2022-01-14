<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

      // asignar el softdeltes
      protected $dates = ["deleted_at"];
      protected $table = "products";
      // campos ocultos 
      protected $hidden = ["created_at","updated_at"];

      public function category(){
          return $this->hasOne(Category::class, 'id', 'category_id');
      }

      public function gallery(){
        return $this->hasMany(ProductGallery::class, 'product_id','id');
      }

   

}
