<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Classes\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $order = (new Cart())->getOrder();

        return view('cart.index', compact('order'));
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

    public function cartAdd(Sku $sku) {

        $result = (new Cart(true))->addSku($sku);
        if ($result) {
            session()->flash('success', __('cart.added').$sku->product->__('title'));
        } else {
            session()->flash('warning', $sku->product->__('title') . __('cart.not_available_more'));
        }

        return redirect()->route('cartIndex');
    }

    public function cartRemove(Sku $sku)
    {
        (new Cart())->removeSku($sku);
        session()->flash('warning', __('cart.removed').$sku->product->__('title'));

        return redirect()->route('cartIndex');
    }
}
