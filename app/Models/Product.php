<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_de',
        'name_fr',
        'name_ar',
        'name_tr',
        'name_zh',
        'description_en',
        'description_de',
        'description_fr',
        'description_ar',
        'description_tr',
        'description_zh',
        'main_image',
        'gallery_images',
        'video',
        'pdf_file',
        'subcategories'
    ];

    protected $casts = [
        'gallery_images' => 'array', 
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategories');
    }
}
