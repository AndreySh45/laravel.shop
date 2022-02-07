<?php

namespace App\ViewComposers;

use App\Models\Order;
use App\Models\Sku;
use Illuminate\View\View;

class BestProductsComposer
{
    public function compose(View $view)
    {
        $bestSkuIds = Order::get()->map->skus->flatten()->map->pivot->mapToGroups(function ($pivot) {
            return [$pivot->sku_id => $pivot->count];
        })->map->sum()->sortByDesc(null)->take(4)->keys()->toArray();


        //$bestProducts = Product::whereIn('id', $bestProductIds)->get();
        $bestSkus = Sku::find($bestSkuIds)->sortBy( function ($sku, $key) use ($bestSkuIds) {
            return array_search($sku->id, $bestSkuIds);
        });

        $view->with('bestSkus', $bestSkus);
    }
}
