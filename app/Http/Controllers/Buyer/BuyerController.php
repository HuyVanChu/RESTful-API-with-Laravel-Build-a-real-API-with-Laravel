<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Model\Buyer;


class BuyerController extends ApiController
{
    public function index()
    {
        $buyer = Buyer::has('transaction')->get();
        // return response()->json(['data' => $buyer], 200);
        return $this->showAll($buyer);
    }
    public function show($id)
    {
        $buyer = Buyer::has('transaction')->findOrfail($id);
        // return response()->json(['data' => $buyer], 200);
        return $this->showOne($buyer);
    }
}
