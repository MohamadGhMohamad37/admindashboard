<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_de',
        'name_fr',
        'name_ar',
        'name_zh',
        'name_tr',
        'description_en',
        'description_de',
        'description_fr',
        'description_ar',
        'description_zh',
        'description_tr',
        'image',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
    ];

}
