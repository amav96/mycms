<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'user_id',
        'status',
        'name',
        'file_path',
        'file_name',
        'content',
        'slider_order',
        'created_at',
        'updated_at'
    ];
}
