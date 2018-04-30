<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type');
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->enum('enable',['yes','no'])->default('yes');
            $table->longText('options')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('categories')->insert([
            'id' => 1,
            'title' => 'عمومی',
            'type' => 'Setting',
        ]);
        DB::table('categories')->insert([
            'id' => 2,
            'title' => 'درگاه پرداخت',
            'type' => 'Setting',
        ]);
        DB::table('categories')->insert([
            'id' => 3,
            'title' => 'محتوا',
            'type' => 'Setting',
        ]);
        DB::table('categories')->insert([
            'id' => 4,
            'title' => 'حساب ها',
            'type' => 'Setting',
        ]);

        DB::table('categories')->insert([
            'id' => 5,
            'title' => 'فاکتور فروش',
            'type' => 'Invoice',
        ]);
        DB::table('categories')->insert([
            'id' => 6,
            'title' => 'فاکتور خرید',
            'type' => 'Invoice',
        ]);
        DB::table('categories')->insert([
            'id' => 7,
            'title' => 'عمومی',
            'type' => 'Article',
        ]);
        DB::table('categories')->insert([
            'id' => 8,
            'title' => 'آموزشی',
            'type' => 'Article',
        ]);
        DB::table('categories')->insert([
            'id' => 9,
            'title' => 'عمومی',
            'type' => 'Item',
        ]);
        DB::table('categories')->insert([
            'id' => 10,
            'title' => 'فایل',
            'type' => 'Item',
        ]);
        DB::table('categories')->insert([
            'id' => 11,
            'title' => 'پشتیبانی',
            'type' => 'Ticket',
        ]);
        DB::table('categories')->insert([
            'id' => 12,
            'title' => 'خدمات نصب',
            'type' => 'Ticket',
        ]);
        DB::table('categories')->insert([
            'id' => 13,
            'title' => 'فروش',
            'type' => 'Income',
        ]);
        DB::table('categories')->insert([
            'id' => 14,
            'title' => 'چک',
            'type' => 'Income',
        ]);

        DB::table('categories')->insert([
            'id' => 15,
            'title' => 'چک',
            'type' => 'Expense',
        ]);

        DB::table('categories')->insert([
            'id' => 16,
            'title' => 'خرید',
            'type' => 'Expense',
        ]);
        DB::table('categories')->insert([
            'id' => 17,
            'title' => 'عمومی',
            'type' => 'File',
        ]);
        DB::table('categories')->insert([
            'id' => 18,
            'title' => 'کالا',
            'type' => 'Item',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
