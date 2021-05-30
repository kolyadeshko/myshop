<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionStatus;
use Illuminate\Http\Request;

class TransactionStatusController extends Controller
{
    // получить все статусы из таблички transaction_status
    public function getTransactionStatuses()
    {
        return TransactionStatus::all();
    }
}
