<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 *  Xem cac route: php artisan route:list
 *  'only'=>['index', 'show'] chi lay 2 ham
 *  'except'=>['create', 'edit'] loai bo 2 ham
 */

/**
 * Buyer
 */
Route::resource('buyers', 'Buyer\BuyerController',['only'=>['index', 'show']]);

/**
 * Category
 */
Route::resource('category', 'Category\CategoryController',['except'=>['create', 'edit']]);

/**
 * Products
 */
Route::resource('product', 'Product\ProductController',['only'=>['index', 'show']]);

/**
 * Sellers
 */
Route::resource('seller', 'Seller\SellerController',['only'=>['index', 'show']]);

/**
 * Transection
 */
Route::resource('transection', 'Transection\TransectionController',['only'=>['index', 'show']]);

/**
 * User
 */
Route::resource('users', 'User\UserController',['except'=>['create', 'edit']]);
