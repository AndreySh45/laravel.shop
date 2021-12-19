<?php

namespace App\Models;

use App\Jobs\SendSubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'product_id'];

    public function scopeActiveByProductId($query, $productId)
    {
        return $query->where('status', 0)->where('product_id', $productId);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function sendEmailsBySubscription(Product $product) //Вызывается при изменении количества товара
    {
        $subscriptions = self::activeByProductId($product->id)->get();

        foreach($subscriptions as $subscription) {
            dispatch(new SendSubscription($product, $subscription))->delay(now()->addMinutes(2));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}