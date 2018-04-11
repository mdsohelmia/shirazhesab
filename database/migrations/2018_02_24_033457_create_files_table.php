<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('source')->nullable();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('item_id')->nullable();
            $table->integer('version_id')->nullable();
            $table->enum('type',['free','paid'])->default('paid');
            $table->enum('published',['yes','no'])->default('no');
            $table->decimal('price', 15, 0)->nullable();
            $table->longText('text')->nullable();
            $table->text('description')->nullable();
            $table->integer('downloads')->default(0);
            $table->integer('purchases')->default(0);
            $table->string('slug')->nullable();
            $table->string('support_link')->nullable();
            $table->string('learn_link')->nullable();
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
        Schema::dropIfExists('files');
    }
}
