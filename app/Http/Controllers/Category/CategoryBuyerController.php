<?php

namespace App\Http\Controllers\Category;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryBuyerController extends Controller
{
    public function index(Category $category)
    {
        $buyers=$category->prodcuts()
            ->whereHas('transactions')
            ->with('transaction.buyer')
            ->get()
            ->puck('transaction')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->value();
        return $this->showAll($buyers);
    }
}
