<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('sale_price', 15, 0);
            $table->decimal('purchase_price', 15, 0)->nullable();
            $table->integer('category_id');
            $table->enum('enable',['yes','no'])->default('yes');
            $table->enum('asset',['yes','no'])->default('no');
            $table->enum('cart',['yes','no'])->default('no');
            $table->integer('period')->nullable();
            $table->string('factory')->nullable();
            $table->integer('factory_id')->nullable();
            $table->double('inventory')->nullable();
            $table->longText('options')->nullable();
            $table->longText('full_description')->nullable();
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
        Schema::dropIfExists('items');
    }
}
