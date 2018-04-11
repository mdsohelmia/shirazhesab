<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_downloads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id');
            $table->integer('user_id');
            $table->string('password')->nullable();
            $table->dateTime('expire_at')->nullable();
            $table->ipAddress('ip')->nullable();
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
        Schema::dropIfExists('file_downloads');
    }
}
