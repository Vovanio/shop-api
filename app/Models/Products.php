<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price'
    ];

    public function getImgSrcAttribute($value){
        return env('APP_DOMAIN') . $value;
    }
}
