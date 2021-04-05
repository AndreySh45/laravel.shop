<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($cat, $product_id){
        $item = Product::where('id', $product_id)->firstOrFail();

        return view('product.show', compact('item'));
    }
    public function showCategory(Request $request, $cat_alias){
        $cat = Category::where('alias',$cat_alias)->firstOrFail();
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

}
