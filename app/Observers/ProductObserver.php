<?php

namespace App\Observers;

use App\Models\Sku;
use App\Models\Subscription;

class ProductObserver
{

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Sku  $sku
     * @return void
     */
    public function updating(Sku $sku)
    {
        $oldCount = $sku->getOriginal('count');

        if ($oldCount == 0 && $sku->count > 0) {
            Subscription::sendEmailsBySubscription($sku);
        }
    }


}
