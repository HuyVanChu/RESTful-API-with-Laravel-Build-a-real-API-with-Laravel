<?php

use App\Model\Product;
use App\Model\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('a/{id}', function ($id) {
    $tran=Transaction::find($id)->product;
    dd($tran);
});