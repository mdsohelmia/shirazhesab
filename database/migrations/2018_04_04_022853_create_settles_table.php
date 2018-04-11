<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlesTable extends Migration
{
    /**
     * Run the migrations.9
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('transaction_id');
            $table->integer('card_id');
            $table->decimal('amount', 15, 0);
            $table->enum('status',['created','pending','settle'])->default('created');
            $table->dateTime('settled_at')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('settles');
    }
}
