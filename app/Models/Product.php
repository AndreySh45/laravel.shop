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
        'category_id',
        'hit',
        'new',
        'recommend'
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
        return asset("uploads/{$img}");
    }

    public function getPriceForCount() {
        if (!is_null($this->count)) {
            return $this->count->count * $this->price;
        }
        return $this->price;
    }

    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }


    public function setInStockAttribute($value)
    {
        $this->attributes['in_stock'] = $value === 'on' ? 1 : 0;
    }

    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }

    public function isIn_stock()
    {
        return $this->in_stock === 1;
    }

    public function isHit()
    {
        return $this->hit === 1;
    }

    public function isNew()
    {
        return $this->new === 1;
    }

    public function isRecommend()
    {
        return $this->recommend === 1;
    }

}
