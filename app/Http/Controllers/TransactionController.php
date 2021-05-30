<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // выводим определенную транзацию
    public function transactionDetail(Request $request, $transactionId = null)
    {
        $transaction = Transaction::query()
            ->where(
                'user_id',
                auth()->user()->id
            );
        // в случае если параметр не задан - считаем что
        // мы хотим получить активную транзацию
        if (is_null($transactionId)) {
            // выбираем активную транзацию
            $transaction = $transaction->where('transaction_status_id', 1);
        } else {
            // в противном случае берем транзакцию по id
            $transaction = $transaction->where('id', $transactionId);
        }
        // если транзакции не существует или она принадлежит не данному пользователю
        // переадресовуем пользователя обратно с сообщением
        if (!$transaction -> exists()) {
            $request->session()->flash(
                'message',
                'Такой транзации не существует'
            );
            return redirect('/');
        }
        $transaction =  $transaction -> first();
        // если все прошло нормально - отдаем представление
        return view('transactionDetail',['transaction' => $transaction]);
    }
}
