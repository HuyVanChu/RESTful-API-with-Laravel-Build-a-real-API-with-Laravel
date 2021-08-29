<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Buyer;
use App\Model\Product;

class Transaction extends Model
{
    // Mo hinh giao dich
    protected $fillable=[
        'quantity',
        'buyer_id',
        'product_id',
    ];
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
