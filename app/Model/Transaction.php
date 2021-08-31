<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Buyer;
use App\Model\Product;

class Transaction extends Model
{
    protected $table='transactions';
    protected $fillable=
    [
        'quantity',
        'buyer_id',
        'product_id',
    ];
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
