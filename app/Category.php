<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    private $fillable = [
      'name',
      'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
