<?php


namespace App\Repositories;


use App\Models\Order;

class OrderRepository
{
    // попытка добавить заказ в транзакцию
    // Ответ будет в виде массива с ключем status=true/false
    // и ключем message
    public function attemptAddOrderToTransaction($data,$transaction)
    {
        // получаем заказ
        $order = $this -> getMyOrder($data['product_id'],$transaction->id) -> first();
        // если такого заказа нету - создаем
        if(!$order)
        {
            $order = Order::query() -> create(
                [
                    'product_id' => $data['product_id'],
                    'transaction_id' => $transaction -> id
                ]
            );
        }

        // проверяем чтобы количество единиц было не null
        if ($order -> count)
        {
            // проверяем не привысим ли мы лимит, если добавим
            // еще какое то количество товаров (лимит 100)
            if ($order -> count + $data['count'] > 100)
            {
                // если лимит привышен, возвращаем сообщение ошибки
                return [
                    'status' => false,
                    'message' => 'Вы не можете заказать более
                    100 единиц данного товара.
                    У вас уже в заказе есть ' . $order->count . ' единиц.
                    То есть вы можете заказать еще максимум ' . (100 - $order -> count)
                ];
            } else
            {
                // если лимин не привышен - просто добавлялем к уже заказанному
                // количеству, новое количество
                $order -> count = $order -> count + $data['count'];
            }
        }
        // если count это null, то записываем него
        // полученное из запроса количество
        else{
            $order -> count = $data['count'];
        }
        $order -> save();

        // если все прошло успешно, возвращаем  статус true
        // и соответствующее сообщение
        return [
            'status' => true,
            'message' => $data['count'] . ' единиц добавлено.
             Теперь у вас в корзине '
            . $order -> count . ' единиц данного товара.'
        ];

    }

    // получение заказа пользователя по id продукта
    public function getMyOrder($productId,$transactionId)
    {
        return Order::query()
            -> where('product_id',$productId)
            -> where('transaction_id',$transactionId)
            -> get();
    }
}
