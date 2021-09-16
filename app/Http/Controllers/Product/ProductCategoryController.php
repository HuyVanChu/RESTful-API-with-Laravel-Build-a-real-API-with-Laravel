<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;

class ProductCategoryController extends ApiController
{
    /**
     * tu 1 san pham, xem o nhung danh muc nao
     */
    public function index(Product $product)
    {
        $categories=$product->categories;
        return $this->showAll($categories);
    }
    public function update(Request $request, Product $product, Category $category)
    {
        // attack, sync, syncWithoutDetach
        /**
         * Them danh muc vao san pham
         * http://localhost/RESTful-API/public/api/products/7/categories/19     PUT
         * attack them vao ds bi trung id
         * sync bo het id khong co trong sync => gio chi con id lap lai luc dung attack
         * syncWithoutDetaching neu da ton tai id thi khong them vao nua
         */
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->showAll($product->categories);
    }

    /**
     * 
     */
    public function destroy(Product $product,Category $category)
    {
        if (!$product->categories()->find($category->id)) {
            return $this->errorResponser('The Specified category is not a category of this product', 404);
        }
        $product->categories()->detach($category->id);
        return $this->showAll($product->categories);
    }
}
