<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Model\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\User;
use Illuminate\Foundation\Testing\HttpException;

class SellerProductController extends ApiController
{
    public function index(Seller $seller)
    {
        $products=$seller->products;
        // return $products;
        return $this->showAll($products);
    }

    public function store(Request $request, User $seller)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'quantity'=>'required|integer|min:1',
            'image'=>'required|image'
        ]);
        $data=$request->all();
        $data['status']=Product::UNAVAILABLE_PRODUCT;
        $data['image']='1.jpg';
        $data['seller_id']=$seller->id;

        $product=Product::create($data);

        return $this->showOne($product);
    }
    // http://localhost/RESTful-API/public/api/seller/7/products/1001
    // 1001 la id store vua them
    public function update(Request $request, Seller $seller, Product $product)
    {
        $this->validate($request, [
            'quantity'=>'integer|min:1',
            'status'=>'in:'.Product::AVAILABLE_PRODUCT. ',' . Product::UNAVAILABLE_PRODUCT,
            'image'=>'image'
        ]);
        $this->checkSeller($seller, $product);
        $product->fill($request->intersect(
            [
                'name',
                'description',
                'quantity'
            ]
            ));
        if ($request->has('status')) {
            $product->status=$request->status;
            if ($product->isAvailable() && $product->categories()->count()==0) {
                return $this->errorResponser('Ac active product must have at least one category', 409);
            }
        }
        if ($product->isClean()) {
            return $this->errorResponser('You need to specify a different value to update', 422);
        }
        $product->save();
        return $this->showOne($product);
    }
    protected function checkSeller(Seller $seller, Product $product){
        if ($seller->id != $product->seller_id) {
            throw new HttpException(422, "The specified seller is not the actual seller of the product. Functione checkSeller");
        }
    }
    public function destroy(Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);
        $product->delete();
        return $this->showOne($product);
    }
}
