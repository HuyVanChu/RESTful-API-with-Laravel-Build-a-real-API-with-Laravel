<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductTransactionController extends ApiController
{
    /**
     * Lay danh sach Transaction theo 1 san pham cu the
     * http://localhost/RESTful-API/public/api/products/1/transactions => rong, do san pham chua co giao dich nao
     */
    public function index(Product $product)
    {
        $transactions=$product->transactions;
        return $this->showAll($transactions);
    }
}
