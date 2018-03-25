<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    private $fillable = [
        'quantity',
        'buyer_id',
        'seller_id',
    ];

    public function buyers()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}