<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password')->nullable();
            $table->string('number')->nullable();
            $table->integer('user_id');
            $table->dateTime('invoice_at')->nullable();
            $table->dateTime('due_at')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('next_at')->nullable();
            $table->integer('period')->nullable();
            $table->text('note')->nullable();
            $table->string('attachment')->nullable();
            $table->decimal('total', 15, 0);
            $table->decimal('tax', 15, 0)->nullable();
            $table->decimal('discount', 15, 0)->nullable();
            $table->enum('status',['draft','sent','normal','approved','partial','paid'])->default('sent');
            $table->enum('type',['sale','purchase']);
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
        Schema::dropIfExists('invoices');
    }
}
