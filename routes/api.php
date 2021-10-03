<?php

use App\Model\Seller;
use App\Model\Transaction;
use App\User;
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
Route::resource('buyers', 'Buyer\BuyerController', ['only' => ['index', 'show']]);
Route::resource('buyers.transactions', 'Buyer\BuyerTransactionController', ['only' => ['index']]);
// http://localhost/RESTful-API/public/api/buyers/123/products
Route::resource('buyers.products', 'Buyer\BuyerProductController', ['only' => ['index']]);
// chua chay dc 
// https://www.youtube.com/watch?v=UCiYxdnJcl8&list=PLw_73jI5PQ-Lpl8mkPdqhK5Nr-UyzjNDx&index=87
Route::resource('buyers.sellers', 'Buyer\BuyerSellerController', ['only' => ['index']]);
// chua chay dc
// https://www.youtube.com/watch?v=6gn1Gk9YpZE&list=PLw_73jI5PQ-Lpl8mkPdqhK5Nr-UyzjNDx&index=88
Route::resource('buyers.categories', 'Buyer\BuyerSellerController', ['only' => ['index']]);

/**
 * Category
 */
Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.products', 'Category\CategoryProductController', ['only' => ['index']]);
// chua dc https://www.youtube.com/watch?v=eZnI7bbario&list=PLw_73jI5PQ-Lpl8mkPdqhK5Nr-UyzjNDx&index=90
Route::resource('categories.sellers', 'Category\CategorySellerController', ['only' => ['index']]);
Route::resource('categories.transactions', 'Category\CategoryTransactionController', ['only' => ['index']]);
//https://www.youtube.com/watch?v=1EvJxWKlIjI&list=PLw_73jI5PQ-Lpl8mkPdqhK5Nr-UyzjNDx&index=92
Route::resource('categories.buyers', 'Category\CategoryBuyerController', ['only' => ['index', 'update', 'destroy']]);

/**
 * Products
 */
Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show']]);
Route::resource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);
Route::resource('products.buyers', 'Product\ProductBuyerController', ['only' => ['index']]);
Route::resource('products.categories', 'Product\ProductCategoryController', ['only' => ['index', 'update', 'destroy']]);
// chua duoc
// https://www.youtube.com/watch?v=8FTyOmwxCG4&list=PLw_73jI5PQ-Lpl8mkPdqhK5Nr-UyzjNDx&index=106
Route::resource('product.buyer.transaction', 'Product\ProductBuyerTransactionController', ['only' => ['store']]);
/**
 * Sellers
 */
Route::resource('seller', 'Seller\SellerController', ['only' => ['index', 'show']]);
Route::resource('seller.transaction', 'Seller\SellerTransactionController', ['only' => ['index']]);
Route::resource('seller.categories', 'Seller\SellerCategoryController', ['only' => ['index']]);
Route::resource('seller.buyers', 'Seller\SellerBuyerController', ['only' => ['index']]);
Route::resource('seller.products', 'Seller\SellerProductController', ['except' => ['index', 'create', 'edit', 'delete']]);
// Route::resource('sellers.products', 'Seller\SellerProductController',['except'=>['index', 'edit']]);
/**
 * Transection
 */
Route::resource('transactions', 'Transection\TransectionController', ['only' => ['index', 'show']]);
Route::resource('transactions.categories', 'Transaction\TransactionCategoryController', ['only' => ['index']]);
Route::resource('transactions.sellers', 'Transaction\TransactionSellerController', ['only' => ['index']]);

/**
 * User
 */
Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);

/**
 * Xac thuc nguoi dung khi dang ki moi
 * truoc do da cai dat 1 package ho tro gui email o trang thai http
 */
Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');

