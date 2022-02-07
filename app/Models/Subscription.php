<?php

namespace App\Models;

use App\Jobs\SendSubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'sku_id'];

    public function scopeActiveBySkuId($query, $skutId)
    {
        return $query->where('status', 0)->where('sku_id', $skutId);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public static function sendEmailsBySubscription(Sku $sku) //Вызывается при изменении количества товара
    {
        $subscriptions = self::activeBySkuId($sku->id)->get();

        foreach($subscriptions as $subscription) {
            dispatch(new SendSubscription($sku, $subscription))->delay(now()->addMinutes(2));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}
