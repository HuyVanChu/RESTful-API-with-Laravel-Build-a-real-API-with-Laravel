<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description',1000);
            $table->integer('quantity')->unsigned();
            $table->string('status')->default(Product::UNAVAILABLE_PRODUCT);
            $table->string('image');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes(); // deleted_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
