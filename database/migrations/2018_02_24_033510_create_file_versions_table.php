<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('source');
            $table->string('link')->nullable();
            $table->double('size')->nullable();
            $table->enum('published',['yes','no'])->default('no');
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
        Schema::dropIfExists('file_versions');
    }
}
