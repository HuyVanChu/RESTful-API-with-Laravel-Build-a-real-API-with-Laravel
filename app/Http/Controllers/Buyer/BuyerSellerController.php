<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Model\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerSellerController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $sellers=$buyer->transaction()->with('product.seller')
            ->get()
            ->puluck('product.seller')
            ->unique('id')
            ->values();
        return $this->showAll($sellers);
    }
}
