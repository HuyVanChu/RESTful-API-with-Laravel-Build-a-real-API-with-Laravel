<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 *  Xem cac route: php artisan route:list
 *  1. 'only'=>['index', 'show'] chi lay 2 ham
 *  2. 'except'=>['create', 'edit'] loai bo 2 ham
 *  3. resource => tiet kiem, khong phai tao nhieu route. resource tao san cho  cac phuong thuc roi
 *  4. Response => Trả lại một phiên bản đầy đủ Response cho phép bạn tùy chỉnh mã trạng thái HTTP của phản hồi và các tiêu đề.
 *  5.  Phan biet get, post, patch, put, delete
 *      https://viblo.asia/q/cac-phuong-thuc-get-post-patch-delete-put-khac-nhau-ntn-Am5yD1rOldb
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
