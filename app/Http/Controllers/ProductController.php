<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;

class ProductController extends Controller
{
    public function sku($cat, $product_id, Sku $sku)
    {
        if ($sku->product->id != $product_id) {
            abort(404, 'Product not found');
        }

        if ($sku->product->category->slug != $cat) {
            abort(404, 'Category not found');
        }

        return view('product.show', compact('sku'));
    }

    public function showCategory(Request $request, $cat_alias){
        $cat = Category::where('slug', $cat_alias)->firstOrFail();
        $paginate = 8;
        $products = Product::where('category_id',$cat->id)->paginate($paginate)->withQueryString();
        if(isset($request->orderBy)){
            if($request->orderBy == 'price-low-high'){
                $products = Product::where('category_id', $cat->id)->orderBy('price')->paginate($paginate)->withQueryString();
            }
            if($request->orderBy == 'price-high-low'){
                $products = Product::where('category_id', $cat->id)->orderBy('price', 'desc')->paginate($paginate)->withQueryString();
            }
            if($request->orderBy == 'name-a-z'){
                $products = Product::where('category_id', $cat->id)->orderBy('title')->paginate($paginate)->withQueryString();
            }
            if($request->orderBy == 'name-z-a'){
                $products = Product::where('category_id', $cat->id)->orderBy('title', 'desc')->paginate($paginate)->withQueryString();
            }
        }

        if($request->ajax()){
            return view('ajax.order-by', compact('products'))->render();
        }


        return view('categories.index', compact('cat', 'products'));
    }

    public function subscribe(SubscriptionRequest $request, Sku $sku)
    {
        Subscription::create([
            'email' => $request->email,
            'sku_id' => $sku->id,
        ]);

        return redirect()->back()->with('success', __('product.we_will_update'));
    }

}
