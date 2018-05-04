<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string('title')->nullable();
            $table->string('api_key')->nullable();
            $table->string('website')->nullable();
            $table->enum('level',['admin','user','staff', 'marketer'])->default('user');
            $table->enum('active',['yes','no'])->default('yes');
            $table->enum('verified',['created','waiting', 'verified', 'rejected'])->default('created');
            $table->string('password');
            $table->string('telegram_user_id')->unique()->nullable();
            $table->string('telegram_password')->unique()->nullable();
            $table->text('note')->nullable();

            //Other Information
            $table->enum('gender',['male','female'])->nullable();
            $table->string('national_code')->unique()->nullable();
            $table->string('birth_certificate_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('address')->nullable();
            $table->text('location')->nullable();

            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();


            $table->string('id_card_file')->nullable();
            $table->string('national_card_file')->nullable();
            $table->string('mobile_password')->nullable();
            $table->string('email_password')->nullable();


            $table->enum('mobile_verified',['yes','no'])->default('no');
            $table->enum('email_verified',['yes','no'])->default('no');
            $table->enum('national_card_file_verified',['yes','no'])->default('no');
            $table->enum('id_card_file_verified',['yes','no'])->default('no');

            $table->ipAddress('register_ip')->nullable();
            $table->ipAddress('last_ip')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('users')->insert([
            'name' => 'علی قاسم زاده',
            'email' => 'it.ghasemzadeh@gmail.com',
            'mobile' => '09177886099',
            'title' => 'مدیر نرم افزار شیراز',
            'level' => 'admin',
            'active' => 'yes',
            'telegram_user_id' => '324083208',
            'telegram_password' => '123321',
            'password' => Hash::make('p@ssw0rd'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
