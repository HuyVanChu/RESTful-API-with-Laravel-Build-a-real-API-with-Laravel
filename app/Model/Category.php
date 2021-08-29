<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class Category extends Model
{
    protected $fillable=[
        'name',
        'description'
    ];

    public function prodcuts()
    {
        return $this->belongsToMany(Product::class);
    }
}
