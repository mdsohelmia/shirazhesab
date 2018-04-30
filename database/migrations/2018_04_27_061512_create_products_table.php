<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('title')->nullable();
            $table->string('source')->nullable();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('item_id')->nullable();
            $table->enum('published',['yes','no'])->default('no');
            $table->enum('top',['yes','no'])->default('no');
            $table->decimal('price', 15, 0)->nullable();
            $table->decimal('off_price', 15, 0)->nullable();
            $table->longText('text')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
