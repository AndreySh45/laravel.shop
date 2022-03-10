<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Classes\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddCouponRequest;

class CartController extends Controller
{
    public function index() {
        $order = (new Cart())->getOrder();

        return view('cart.index', compact('order'));
    }

    public function cartConfirm(Request $request)
    {
        $cart = new Cart();
        if ($cart->getOrder()->hasCoupon() && !$cart->getOrder()->coupon->availableForUse()) {
            $cart->clearCoupon();
            session()->flash('warning', 'Купон не доступен для использования');
            return redirect()->route('cartIndex');
        }
        $email = Auth::check() ? Auth::user()->email : $request->email;
        if ($cart->saveOrder($request->name, $request->phone, $email)) {
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
            session()->flash('warning', $sku->product->__('title').__('cart.not_available_more'));
        }

        return redirect()->route('cartIndex');
    }

    public function cartRemove(Sku $sku)
    {
        (new Cart())->removeSku($sku);
        session()->flash('warning', __('cart.removed').$sku->product->__('title'));

        return redirect()->route('cartIndex');
    }

    public function setCoupon(AddCouponRequest $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();

        if ($coupon->availableForUse()) { //купон можно использовать
            (new Cart())->setCoupon($coupon);
            session()->flash('success', 'Купон был добавлен к заказу');
        } else {
            session()->flash('warning', 'Купон не может быть использован');
        }

        return redirect()->route('cartIndex');
    }
}
