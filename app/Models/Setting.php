<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'name',
        'url',
        'image',
        'address',
        'address_href',
        'phone',
        'phone_href',
        'email',
        'email_href',
        'facebook',
        'twitter',
        'instagram',
        'youtube'
    ];
}
