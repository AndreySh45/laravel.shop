<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return view('cart.index', compact('order'));
    }

    public function cartConfirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        //dd($request);
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Случилась ошибка');
        }

        return redirect()->route('index');
    }

    public function cartPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);

        return view('order.index', compact('order'));
    }



    public function cartAdd($productId) {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        }else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) { //Проверка есть ли такой продукт в корзине?
            $pivotRow = $order->products()->where('product_id', $productId)->first()->count; //Находим поле count
            $pivotRow->count++; //Увеличиваем на один
            $pivotRow->update();
        } else {
            $order->products()->attach($productId); // Если такого товара нет, то добавляем его в корзину
        }

        if (Auth::check()) { //Если пользователь авторизован
            $order->user_id = Auth::id(); //В поле user_id записываем ID пользователя
            $order->save();
        }

        $product = Product::find($productId);
        session()->flash('success', 'Добавлен товар ' . $product->title);

        return redirect()->route('cartIndex');
    }


    public function cartRemove($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->count; //Находим поле count
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId); //Если товар в одном экземпляре удаляем его из корзины
            } else {
                $pivotRow->count--; //Уменьшаем на один
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);
        session()->flash('warning', 'Удален товар  ' . $product->title);

        return redirect()->route('cartIndex');
    }


}
