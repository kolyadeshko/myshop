<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'transaction_id',
        'product_id',
        'count'
    ];


    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id'
        );
    }

}
