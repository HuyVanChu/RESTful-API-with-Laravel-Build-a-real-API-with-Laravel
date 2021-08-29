<?php
use App\User;
use App\Model\Category;
use App\Model\Product;
use App\Model\Seller;
use App\Model\Transaction;


$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER,User::UNVERIFIED_USER]),
        'verification_token'=> $verified = User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'admin' => $verified = $faker->randomElement([User::ADMIN_USER,User::REGUlAR_USER]),
    ];
});
$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1)
    ];
});
$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1,10),
        'status' => $faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
        'image' => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'seller_id'=>User::all()->random()->id
    ];
});
$factory->define(Transaction::class, function (Faker\Generator $faker) {
    
    $seller = Seller::has('products')->get()->random();
    $buyer=User::all()->except($seller->id)->random();

    return [
        'quantity' => $faker->numberBetween(1,3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,

    ];
});
