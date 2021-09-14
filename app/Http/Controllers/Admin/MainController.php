<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $products_count = Product::all()->count();
        $categories_count = Category::all()->count();
        $orders_count = Order::where('status', 1)->count();

        return view('admin.home.index', compact('products_count', 'categories_count', 'orders_count'));
    }
}
