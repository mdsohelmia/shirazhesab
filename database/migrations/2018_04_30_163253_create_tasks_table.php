<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->integer('user_id');
            $table->integer('customer_user_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('ticket_id')->nullable();
            $table->integer('invoice_id')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->enum('status',['done','doing','active','waiting', 'new'])->default('new');
            $table->enum('priority',['normal','urgent','important'])->default('normal');
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
        Schema::dropIfExists('tasks');
    }
}
