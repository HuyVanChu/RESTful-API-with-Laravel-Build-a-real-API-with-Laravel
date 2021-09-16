<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductBuyerController extends ApiController
{
    /**
     * with() https://laravel.com/docs/5.4/eloquent-relationships#eager-loading
     * puck() https://laravel.com/docs/8.x/collections#method-pluck
     * unique() https://laravel.com/docs/8.x/collections#method-unique
     * values() https://laravel.com/docs/8.x/collections#method-values
     */
    public function index(Product $product)
    {
        $buyer=$product->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->unique('id')
            ->values();
        return $this->showAll($buyer);
    }
}
