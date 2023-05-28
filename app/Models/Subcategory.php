<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category_id',
        'status',
        'is_popular'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
