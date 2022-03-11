<?php

namespace App\Models;

use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sku extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['product_id', 'count', 'price', 'new_price'];
    protected $visible = ['id', 'count', 'price', 'product_name'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeAvailable($query) //Выбрать предложения которые есть в наличии
    {
        return $query->where('count', '>', 0);
    }

    public function propertyOptions()
    {
        return $this->belongsToMany(PropertyOption::class, 'sku_property_option')->withTimestamps();
    }

    public function isAvailable()
    {
        return !$this->product->trashed() && $this->count > 0;
    }

    public function getPriceForCount() {
        if (!is_null($this->countInOrder)) {
            return $this->countInOrder * $this->price;
        }
        return $this->price;
    }

     //Для отображения измененной цены в карточке товара
    public function getPriceAttribute($value)
     {
         return round(CurrencyConversion::convert($value), 2);
     }

    public function getProductNameAttribute() //Получение 'product_name'
    {
        return $this->product->title;
    }
}
