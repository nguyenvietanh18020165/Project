<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'address',
        'avatar',
        'webisite'
    ];
}
