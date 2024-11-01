<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_de',
        'name_tr',
        'name_ar',
        'name_fr',
        'name_zh',
        'description_en',
        'description_de',
        'description_tr',
        'description_ar',
        'description_fr',
        'description_zh',
        'image',
        'images',
        'pdf_file',
        'category_id'
    ];

    protected $casts = [
        'images' => 'array',
    ];
    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
        // Relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
