<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id', 'variant_id', 'quantity'
    ];

    public function variant() {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
}
