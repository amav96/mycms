<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{

    use SoftDeletes;

    // asignar el softdeltes
    protected $dates = ["deleted_at"];
    protected $table = "product_gallery";
    // campos ocultos 
    protected $hidden = ["created_at","updated_at"];

    
}
