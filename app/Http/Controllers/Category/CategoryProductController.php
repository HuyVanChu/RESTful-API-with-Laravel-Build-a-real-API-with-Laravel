<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryProductController extends ApiController
{
    /**
     * 
     */
    public function index(Category $category)
    {
        $products=$category->prodcuts;
        return $this->showAll($products);
    }
}
