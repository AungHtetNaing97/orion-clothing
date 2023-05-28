<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    use HasFactory;

    protected $table = 'colors_sizes';

    protected $fillable = [
        'color_id',
        'size_id',
        'quantity'
    ];

    public function color() {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function size() {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
