<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;

class ProductController extends Controller
{
    public function show($cat, $product_id){
        $item = Product::where('id', $product_id)->firstOrFail();

        return view('product.show', compact('item'));
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

    public function subscribe(SubscriptionRequest $request, Product $product)
    {
        Subscription::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Спасибо, мы сообщим вам о поступлении товара');
    }

}
