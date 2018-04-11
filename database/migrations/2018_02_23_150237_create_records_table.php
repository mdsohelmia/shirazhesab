<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->decimal('price', 15, 0);
            $table->double('quantity')->default(1);
            $table->double('total');
            $table->integer('invoice_id');
            $table->integer('item_id')->nullable();
            $table->decimal('tax', 15, 0)->nullable();
            $table->decimal('discount', 15, 0)->nullable();
            $table->integer('coupon_id')->nullable();
            $table->dateTime('next_at')->nullable();
            $table->enum('next_invoice',['yes','no'])->default('no');
            $table->longText('options')->nullable();
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
        Schema::dropIfExists('records');
    }
}
