<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('route');
            $table->enum('position',['admin-sidebar', 'user-sidebar', 'navbar-top', 'navbar-bottom'])->default('user-sidebar');
            $table->string('icon');
            $table->enum('active',['yes', 'no'])->default('yes');
            $table->enum('type',['route', 'link'])->default('route');
            $table->enum('access',['public', 'private'])->default('public');
            $table->integer('order_number')->nullable();
            $table->timestamps();
        });
        DB::table('menus')->insert([
            'title' => 'انجمن',
            'route' => 'discussion',
            'icon' => 'fa fa-comments-o',
            'position' => 'navbar-bottom',
        ]);
        DB::table('menus')->insert([
            'title' => 'تماس با ما',
            'route' => 'contact-us',
            'icon' => 'fa fa-envelope-o',
            'position' => 'navbar-bottom',
        ]);
        DB::table('menus')->insert([
            'title' => 'درباره ما',
            'route' => 'about-us',
            'icon' => 'fa fa-info-circle',
            'position' => 'navbar-bottom',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
