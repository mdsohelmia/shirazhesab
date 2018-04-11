<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->string('title');
            $table->string('code');
            $table->decimal('price', 15, 0)->nullable();
            $table->double('percent')->nullable();
            $table->enum('type',['percent','price']);
            $table->double('limit_count')->nullable();
            $table->double('use_count')->nullable();
            $table->dateTime('expire_at')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
