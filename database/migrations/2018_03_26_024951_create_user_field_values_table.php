<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_field_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('user_field_id');
            $table->string('code')->nullable();
            $table->enum('verified',['yes','no'])->default('no');
            $table->text('value')->nullable();
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
        Schema::dropIfExists('user_field_values');
    }
}
