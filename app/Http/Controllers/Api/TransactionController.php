<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;

class TransactionController extends Controller
{
    public function getTransactionsWithOrders(Request $request, TransactionRepository $transactionRepository)
    {
        // присваиваем переменной статус транзакции
        // если в запросе статус не пришел, присваиваем значение ALL
        $transactionStatus = $request->input('transactionStatus') ?? 0;
        return $transactionRepository->getTransactionsWithOrders($transactionStatus);
    }

    public function deleteMyTransaction(TransactionRepository $transactionRepository, $transactionId)
    {
        $transactionRepository->deleteMyTransactionByIdWithOrder($transactionId);
    }

    // изменение статуса из "Заказ формируется" в статус "Заказ обработке"
    // или наоброт
    public function changeTransactionStatus(Request $request)
    {
        $transactionId = $request->input('transactionId');

        $transaction = Transaction::query()
            ->where('id', $transactionId)
            ->where('user_id', auth()->user()->id)
            ->whereIn('transaction_status_id', [1, 2]);
        abort_if(!$transaction->exists(),404);
        $transaction = $transaction -> first();
        $currentStatus = $transaction -> transaction_status_id;
        $newStatus = $currentStatus == 1 ? 2 : 1;
        $transaction -> transaction_status_id  = $newStatus;
        $transaction -> update();
    }


}
