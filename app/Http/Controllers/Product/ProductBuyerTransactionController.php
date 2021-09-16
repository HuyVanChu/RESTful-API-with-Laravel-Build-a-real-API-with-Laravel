<?php

namespace App\Http\Controllers\Product;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\Transaction;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Buyer $buyer, Product $product)
    {
        // $this->validate($request, [
        //     'quantity'=>'required|min:1',
        // ]);
        // // Xac minh ng dung va nguoi ban hang
        // if ($buyer->id==$product->seller_id) {
        //     return $this->errorResponser('The Buyer must be different form the seller', 409);
        // }
        // if (!$buyer->isVerified()) {
        //     return $this->errorResponser('The seller must be a verified user', 409);

        // }
        // if (!$product->seller->isVerified()) {
        //     return $this->errorResponser('The seller must be a verified user product', 409);

        // }
        // if (!$product->isVerified()) {
        //     return $this->errorResponser('The product is not available', 409);

        // }
        // if ($product->quantity < $request->quantity) {
        //     return $this->errorResponser('The product does not have anough units for this transaction', 409);
        // }
        // return DB::transaction(function () use( $request, $product, $buyer) {
        //     $product->quantity -= $request->quantity;
        //     $product->save();
        //     $transaction=Transaction::create(
        //         [
        //             'quantity'=>$request->quantity,
        //             'buyer_id'=>$buyer->id,
        //             'product_id'=>$product->id,    
        //         ]);
        //     return $this->showOne($transaction, 201);
        // });
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
