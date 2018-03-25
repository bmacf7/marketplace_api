<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const PRODUCT_AVAILABLE = 'available';
    const PRODUCT_UNAVAILABLE = 'unavailable';

    private $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
    ];

    public function isAvailable()
    {
        return $this->status == Product::PRODUCT_AVAILABLE;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
