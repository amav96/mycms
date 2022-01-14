<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;

    // asignar el softdeltes
    protected $dates = ["deleted_at"];
    protected $table = "categories";
    // campos ocultos 
    protected $hidden = ["created_at","updated_at"];

     // SCOPE

     public function products(){
        return $this->hasMany(Product::class, 'category_id','id');
      }

     public function scopeCategories($query, $module){
        return $query->where('module', $module)
                     ->orderBy('name', 'Asc');
                     
    }
}
