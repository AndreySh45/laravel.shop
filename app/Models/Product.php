<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'in_stock',
    ];
    public function images(){
        return $this->hasMany('App\Models\ProductImage');
    }

}
