<?php

namespace App\Model;
use App\Model\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    protected $table='users';
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
