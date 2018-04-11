<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->nullable();
            $table->integer('account_id');
            $table->integer('user_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->decimal('amount', 15, 0);
            $table->text('gateway')->nullable();
            $table->text('description')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('password')->nullable();
            $table->dateTime('transaction_at')->nullable();
            $table->dateTime('due_at')->nullable();
            $table->enum('status',['temporary','confirmed','accepted'])->default('confirmed');

            $table->integer('gateway_id')->nullable();
            $table->string('gateway_order')->nullable();

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
        Schema::dropIfExists('transactions');
    }
}
