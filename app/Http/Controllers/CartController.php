<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $order = (new Cart())->getOrder();
        $products = $order->products()->with('category')->get();

        return view('cart.index', compact('order', 'products'));
    }

    public function cartConfirm(Request $request)
    {
        $email = Auth::check() ? Auth::user()->email : $request->email;
        if ((new Cart())->saveOrder($request->name, $request->phone, $email)) {
            session()->flash('success', __('cart.you_order_confirmed'));
        } else {
            session()->flash('warning', __('cart.you_cant_order_more'));
        }

        return redirect()->route('index');
    }

    public function cartPlace()
    {
        $cart = new Cart();
        $order = $cart->getOrder();
        if (!$cart->countAvailable()) {
            session()->flash('warning',  __('cart.you_cant_order_more'));
            return redirect()->route('cartIndex');
        }

        return view('order.index', compact('order'));
    }

    public function cartAdd(Product $product) {

        $result = (new Cart(true))->addProduct($product);
        if ($result) {
            session()->flash('success', __('cart.added').$product->title);
        } else {
            session()->flash('warning', $product->title . __('cart.not_available_more'));
        }

        return redirect()->route('cartIndex');
    }

    public function cartRemove(Product $product)
    {
        (new Cart())->removeProduct($product);
        session()->flash('warning', __('cart.removed').$product->title);

        return redirect()->route('cartIndex');
    }
}
