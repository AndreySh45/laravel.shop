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
        'category_id'
    ];
    public function images(){
        return $this->hasMany('App\Models\ProductImage');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function getImage()
    {
        $img = $this->images[0]['img'];
        if (!$img) {
            return asset("no_image.png");
        }
        return $img;
    }

}
