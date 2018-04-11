<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('category_id');
            $table->longText('description')->nullable();
            $table->string('linker')->nullable(); //email,mobile,name
            $table->enum('required',['yes','no'])->default('no');
            $table->enum('verifiable',['yes','no'])->default('no');
            $table->string('type'); //file,yesno,text,textarea,select,select-table,enabled
            $table->text('options')->nullable();
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
        Schema::dropIfExists('user_fields');
    }
}
