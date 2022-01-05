<?php

namespace App\Classes;

use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderCreated;
use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Cart
{
    protected $order;


    /**
     * Basket constructor.
     * @param  bool  $createOrder
     */
    public function __construct($createOrder = false)
    {
        $order = session('order');

        if (is_null($order) && $createOrder) {
            $data = [];
            if (Auth::check()) { //Если пользователь авторизован
                $data['user_id'] = Auth::id();  //В поле user_id записываем ID пользователя
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;

            $this->order = new Order($data);
            session(['order' => $this->order]);
        } else {
            $this->order = $order;
        }
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function countAvailable($updateCount = false)
    {
        $products = collect([]);
        foreach ($this->order->products as $orderProduct)
        {
            $product = Product::find($orderProduct->id);
            if ($orderProduct->countInOrder > $product->count) {
                return false;
            }

            if ($updateCount) {
                $product->count -= $orderProduct->countInOrder;
                $products->push($product);
            }
        }

        if ($updateCount) {
            $products->map->save();
        }

        return true;
    }

    public function saveOrder($name, $phone, $email)
    {
        if (!$this->countAvailable(true)) {
            return false;
        }
        $this->order->saveOrder($name, $phone);
        Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));

        return true;
    }


    public function removeProduct(Product $product)
    {
        if ($this->order->products->contains($product)) {
            $pivotRow = $this->order->products->where('id', $product->id)->first(); //Находим сведения о товаре
            if ($pivotRow->countInOrder < 2) {
                $this->order->products->pop($product); //Если товар в одном экземпляре удаляем его из корзины
            } else {
                $pivotRow->countInOrder--; //Уменьшаем на один
            }
        }

    }

    public function addProduct(Product $product)
    {
        if ($this->order->products->contains($product)) { //Проверка есть ли такой продукт в корзине?
            $pivotRow = $this->order->products->where('id', $product->id)->first(); //Находим сведения о товаре
            if ($pivotRow->countInOrder >= $product->count) { //проверка можно ли добавить товар
                return false;
            }
            $pivotRow->countInOrder++; //Увеличиваем на один
        } else {
            if ($product->count == 0) {
                return false;
            }
            $product->countInOrder =1;
            $this->order->products->push($product); // Если такого товара нет, то добавляем его в корзину
        }

        return true;
    }
}
