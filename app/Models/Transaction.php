<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','transaction_status_id'];

    public function orders()
    {
        return $this -> hasMany(
            Order::class,
            "transaction_id"
        );
    }
}
