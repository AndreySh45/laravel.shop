<?php

namespace App\ViewComposers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class BestProductsComposer
{
    public function compose(View $view)
    {
        $bestProductIds = Order::get()->map->products->flatten()->map->pivot->mapToGroups(function ($pivot) {
            return [$pivot->product_id => $pivot->count];
        })->map->sum()->sortByDesc(null)->take(4)->keys()->toArray();


        //$bestProducts = Product::whereIn('id', $bestProductIds)->get();
        $bestProducts = Product::find($bestProductIds)->sortBy( function ($product, $key) use ($bestProductIds) {
            return array_search($product->id, $bestProductIds);
        });

        $view->with('bestProducts', $bestProducts);
    }
}
