<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'sale_price',
        'category_id',
        'subcategory_id',
        'brand_id',
        'code',
        'status',
        'trending',
        'featured'
    ];

    public function productImages() {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory() {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function variants() {
        return $this->hasMany(Variant::class, 'product_id', 'id');
    }
}
