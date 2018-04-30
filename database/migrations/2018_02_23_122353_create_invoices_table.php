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
            $table->string('period')->nullable(); //1m,2m,3m,4m,5m,6m,7 1y,2y,3y,4y,5y,6y
            $table->text('note')->nullable();
            $table->string('attachment')->nullable();
            $table->decimal('total', 15, 0);
            $table->decimal('tax', 15, 0)->nullable();
            $table->decimal('discount', 15, 0)->nullable();
            $table->enum('status',['draft','sent','normal','approved','partial','paid' ,'done' ,'post'])->default('sent');
            $table->enum('type',['sale','purchase']);
            $table->integer('next_invoice_id')->nullable();
            $table->longText('options')->nullable();

            //Information
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('address')->nullable();
            $table->text('location')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();

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
