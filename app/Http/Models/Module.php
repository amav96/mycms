<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = "modules";


    // SCOPE

    public function scopeModules($query){
        return $query->orderBy('module','Asc');
                     
    }

}
