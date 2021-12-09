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

        return view('cart.index', compact('order'));
    }

    public function cartConfirm(Request $request)
    {
        if ((new Cart())->saveOrder($request->name, $request->phone)) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Товар не доступен для заказа в полном объеме');
        }

        Order::eraseOrderSum();

        return redirect()->route('index');
    }

    public function cartPlace()
    {
        $cart = new Cart();
        $order = $cart->getOrder();
        if (!$cart->countAvailable()) {
            session()->flash('warning', 'Товар не доступен для заказа в полном объеме');
            return redirect()->route('cartIndex');
        }

        return view('order.index', compact('order'));
    }

    public function cartAdd(Product $product) {

        $result = (new Cart(true))->addProduct($product);
        if ($result) {
            session()->flash('success', 'Добавлен товар '.$product->title);
        } else {
            session()->flash('warning', 'Товар '.$product->title . ' в большем кол-ве не доступен для заказа');
        }

        return redirect()->route('cartIndex');
    }

    public function cartRemove(Product $product)
    {
        (new Cart())->removeProduct($product);
        session()->flash('warning', 'Удален товар  '.$product->title);

        return redirect()->route('cartIndex');
    }
}
