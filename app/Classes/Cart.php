<?php

namespace App\Classes;

use App\Models\Order;
use App\Mail\OrderCreated;
use App\Models\Sku;
use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Cart
{
    protected $order;


    /**
     * Cart constructor.
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
        $skus = collect([]);
        foreach ($this->order->skus as $orderSku)
        {
            $sku = Sku::find($orderSku->id);
            if ($orderSku->countInOrder > $sku->count) {
                return false;
            }

            if ($updateCount) {
                $sku->count -= $orderSku->countInOrder;
                $skus->push($sku);
            }
        }

        if ($updateCount) {
            $skus->map->save();
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


    public function removeSku(Sku $sku)
    {
        if ($this->order->skus->contains($sku)) {
            $pivotRow = $this->order->skus->where('id', $sku->id)->first(); //Находим сведения о товаре
            if ($pivotRow->countInOrder < 2) {
                $this->order->skus->pop($sku); //Если товар в одном экземпляре удаляем его из корзины
            } else {
                $pivotRow->countInOrder--; //Уменьшаем на один
            }
        }

    }

    public function addSku(Sku $sku)
    {
        if ($this->order->skus->contains($sku)) { //Проверка есть ли такой продукт в корзине?
            $pivotRow = $this->order->skus->where('id', $sku->id)->first(); //Находим сведения о товаре
            if ($pivotRow->countInOrder >= $sku->count) { //проверка можно ли добавить товар
                return false;
            }
            $pivotRow->countInOrder++; //Увеличиваем на один
        } else {
            if ($sku->count == 0) {
                return false;
            }
            $sku->countInOrder = 1;
            $this->order->skus->push($sku); // Если такого товара нет, то добавляем его в корзину
        }

        return true;
    }
}
