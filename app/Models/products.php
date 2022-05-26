<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'code',
        'name',
        'description',
        'category_id',
        'price',
        'is_top',
        'on_sale',
        'slug',
        'count'
    ];
}
