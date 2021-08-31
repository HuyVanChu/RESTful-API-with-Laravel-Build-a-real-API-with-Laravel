<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Model\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerTransactionController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transaction;
        return $this->showAll($transactions);
    }
}
