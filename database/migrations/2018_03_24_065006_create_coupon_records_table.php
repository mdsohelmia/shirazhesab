<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id');
            $table->integer('user_id');
            $table->integer('record_id');
            $table->decimal('price', 15, 0)->nullable();
            $table->double('percent')->nullable();
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
        Schema::dropIfExists('coupon_records');
    }
}
