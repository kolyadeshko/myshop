<?php


namespace App\Repositories;
use App\Models\Transaction;

class TransactionRepository
{
    // Массив в кодами статуса транзакции для повышения читаемости кода
    static public $status = [
        'ACTIVE' => 1,// Формируемая транзакция в которую можно добавлять заказы
        'IN_PROCESSING' => 2, // транзакция на обработке
        'ON_THE_ROAD' => 3, // заказ уже доставляется
        'COMPLETED' => 4,// завершенный заказ
        'CANCELED' => 5 // отмененный заказ
    ];


    public function getActiveTransaction()
    {
        // получаем активную транзакцию в которым мы можем добавить
        // какие то товары
        $transaction = $this->getMyTransactionsByStatus(self::$status['ACTIVE']) -> first();
        // если у данного пользователя нет активной транзации, создаем ее
        if (!$transaction)
        {
            $transaction = Transaction::query() -> create(
                [
                    'user_id' => auth() -> user() -> id,
                    'transaction_status_id' => self::$status['ACTIVE']
                ]
            );
        }
        return $transaction;
    }

    // получение транзакций по статусу пользователя
    public function getMyTransactionsByStatus(int $status = 1){
        return Transaction::query()
            -> where('user_id',auth() -> user() -> id)
            -> where('transaction_status_id',self::$status['ACTIVE'])
            -> get();
    }
}
