<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Model\Transaction;
use Illuminate\Http\Request;

class TransactionCategoryController extends ApiController
{
    public function index(Transaction $transaction)
    {
        $category=$transaction->products->categories;
        return $this->showAll($category);
    }
}
