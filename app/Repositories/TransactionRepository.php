<?php


namespace App\Repositories;
use App\Models\Order;
use App\Models\Transaction;

class TransactionRepository extends Repository
{
    // Массив в кодами статуса транзакции для повышения читаемости кода
    static public $status = [
        'ACTIVE' => 1,// Формируемая транзакция в которую можно добавлять заказы
        'IN_PROCESSING' => 2, // транзакция на обработке
        'ON_THE_ROAD' => 3, // заказ уже доставляется
        'COMPLETED' => 4,// завершенный заказ
        'CANCELED' => 5 // отмененный заказ
    ];


    // удалить опредленную транзакцию пользователя вмессте со всеми
    // ее товарами
    public function deleteMyTransactionByIdWithOrder($transactionId)
    {
        // находим эту транзакцию в бд
        $transaction = Transaction::query()
            -> where('id',$transactionId)
            -> where('user_id', $this->user->id);
        // проверяем есть ли в бд такая транзакция
        if (Transaction::query()->exists())
        {
            // если такая транзация существует, то удаляем ее
            $transaction -> delete();
            // заказы из таблицы удалятся каскадно из за ограничения
            // внешнего ключа
        }
    }



    public function getActiveTransaction()
    {
        // получаем активную транзакцию в которым мы можем добавить
        // какие то товары
        $transaction = $this->getMyTransactionsByStatus(self::$status['ACTIVE']) -> get() -> first();
        // если у данного пользователя нет активной транзации, создаем ее
        if (!$transaction)
        {
            $transaction = Transaction::query() -> create(
                [
                    'user_id' => $this -> user -> id,
                    'transaction_status_id' => self::$status['ACTIVE']
                ]
            );
        }
        return $transaction;
    }

    // получить транзакции с заказами
    public function getTransactionsWithOrders($status){
        return $this -> getMyTransactionsByStatus($status)
            -> with('orders.product') -> get();
    }
    // получение транзакций по статусу пользователя
    public function getMyTransactionsByStatus(int $status = 1){
        $transactions = Transaction::query()
            -> where('user_id',$this -> user -> id);
        // если пришел статус =0, то значит нужно отдать все транзакции без учета статуса
        return $status !== 0 ?
            $transactions -> where('transaction_status_id',$status) : $transactions;
    }
}
