<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;

class TransactionController extends Controller
{

    public function getTransactionsWithOrders(Request $request,TransactionRepository $transactionRepository)
    {
        // присваиваем переменной статус транзакции
        // если в запросе статус не пришел, присваиваем значение ALL
        $transactionStatus = $request -> input('transactionStatus') ?? 0;
        return $transactionRepository -> getTransactionsWithOrders($transactionStatus);
    }
    public function deleteMyTransaction(TransactionRepository $transactionRepository,$transactionId)
    {
        $transactionRepository -> deleteMyTransactionByIdWithOrder($transactionId);
    }
}
