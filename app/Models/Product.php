<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes, Translatable;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'title_en',
        'description_en',
        'category_id',
        'hit',
        'new',
        'recommend',
    ];
    public function images(){
        return $this->hasMany('App\Models\ProductImage');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }


    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_product')->withTimestamps();
    }

    public function getImage()
    {
        $img = $this->images[0]['img'];
        if (!$img) {
            return asset("no_image.png");
        }
        return asset("uploads/{$img}");
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

    //Для отображения измененной цены в карточке товара
    public function getPriceAttribute($value)
    {
        return round(CurrencyConversion::convert($value), 2);
    }

}
