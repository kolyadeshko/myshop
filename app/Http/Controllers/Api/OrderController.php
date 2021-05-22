<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Repositories\OrderRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    // удаление заказа с транзакции
    public function deleteOrderFromTransaction(Request $request,OrderRepository $orderRepository)
    {
        $orderRepository -> deleteMyOrderFromTransaction(
            $request -> input('orderId'),
            $request -> input('transactionId'),
        );
    }



    // добавление товара в корзину товаров (активную транзакцию)
    public function addOrderToCart(
        Request $request,
        TransactionRepository $transactionRepository,
        OrderRepository $orderRepository
    )
    {
        // если данные не валидны, возвращаем ответ валидатора
        $validateAnswer = $this->validateOrderData($request->all());
        if (!$validateAnswer['status']) {
            return $validateAnswer;
        }
        // получаем активную транзакцию для данного пользователя
        $transaction = $transactionRepository->getActiveTransaction();

        // пытаемся добавить данный товар в корзину
        $addOrderAnswer = $orderRepository -> attemptAddOrderToTransaction(
            $request -> all(),
            $transaction
        );

        return $addOrderAnswer;
    }

    // проверяет данные которые пришли при попытке добавить
    // товар в корзину. В случае если валидация не прошла
    // возвращаем массив с ключем status=false, а в ключ
    // answer помещаем ошибки
    private function validateOrderData($data)
    {
        $validator = Validator::make(
            $data,
            [
                'product_id' => ['exists:App\Models\Product,id'],
                'count' => ['integer', 'gte:1', 'lte:100']
            ],
            [
                'product_id.exists' => 'Данного товара не в нашей магазине нет',
                'count.integer' => 'Количество товаров должно быть числом',
                'count.gte' => 'Количество товаров должно быть неменьше 1-го',
                'count.lte' => 'Количество товаров должно быть не больше 100'
            ]
        );

        return [
            'status' => !$validator->fails(),
            'message' => $validator->errors()->first()
        ];
    }


}
