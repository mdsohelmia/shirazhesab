<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->integer('user_id');
            $table->string('api_key')->unique()->nullable();
            $table->string('payment_password')->nullable();
            $table->string('callback_password')->nullable();
            $table->string('website')->nullable();
            $table->string('code')->unique()->nullable();
            $table->enum('enable',['yes','no'])->default('yes');
            $table->enum('verity',['yes','no'])->default('no');
            $table->enum('wage',['user','subscribe','settle'])->default('settle');
            $table->double('percent')->default(1);
            $table->longText('ips')->nullable();
            $table->dateTime('expire_at')->nullable();
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
        Schema::dropIfExists('gateways');
    }
}
