<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('file_id');
            $table->text('text');
            $table->text('answer');
            $table->enum('status',['new','reject','accept'])->default('new');
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
        Schema::dropIfExists('file_comments');
    }
}
