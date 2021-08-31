<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Model\Transaction;

class TransactionSellerController extends ApiController
{
    public function index(Transaction $transaction)
    {
        $seller=$transaction->product->seller;
        return $this->showOne($seller);
    }
}
