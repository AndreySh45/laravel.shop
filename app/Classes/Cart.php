<?php

namespace App\Classes;

use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderCreated;
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
        $orderId = session('orderId');

        if (is_null($orderId) && $createOrder) {
            $data = [];
            if (Auth::check()) { //Если пользователь авторизован
                $data['user_id'] = Auth::id();  //В поле user_id записываем ID пользователя
            }

            $this->order = Order::create($data);
            session(['orderId' => $this->order->id]);
        } else {
            $this->order = Order::findOrFail($orderId);
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
        foreach ($this->order->products as $orderProduct)
        {
            if ($orderProduct->count < $this->getPivotRow($orderProduct)->count) {
                return false;
            }
            if ($updateCount) {
                $orderProduct->count -= $this->getPivotRow($orderProduct)->count;
            }
        }
        if ($updateCount) {
            $this->order->products->map->save();
        }

        return true;
    }

    public function saveOrder($name, $phone, $email)
    {
        if (!$this->countAvailable(true)) {
            return false;
        }

        Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));

        return $this->order->saveOrder($name, $phone);
    }

    protected function getPivotRow($product)
    {
        return $this->order->products()->where('product_id', $product->id)->first()->pivot; //Находим поле count
    }

    public function removeProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product); //Находим поле count
            if ($pivotRow->count < 2) {
                $this->order->products()->detach($product->id); //Если товар в одном экземпляре удаляем его из корзины
            } else {
                $pivotRow->count--; //Уменьшаем на один
                $pivotRow->update();
            }
        }

        Order::changeFullSum(-$product->price);
    }

    public function addProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) { //Проверка есть ли такой продукт в корзине?
            $pivotRow = $this->getPivotRow($product); //Находим поле count
            $pivotRow->count++; //Увеличиваем на один
            if ($pivotRow->count > $product->count) { //проверка можно ли добавить товар
                return false;
            }
            $pivotRow->update();
        } else {
            if ($product->count == 0) {
                return false;
            }
            $this->order->products()->attach($product->id); // Если такого товара нет, то добавляем его в корзину
        }

        Order::changeFullSum($product->price);

        return true;
    }
}
