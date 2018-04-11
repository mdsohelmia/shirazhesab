<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('key')->unique();
            $table->string('type'); //file,yesno,text,textarea,select,select-table,enabled
            $table->text('options')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            'title' => 'عنوان سایت',
            'category_id' => '1',
            'description' => 'عنوان سایت شما که در بالای سایت نمایش داده می شود.',
            'key' => 'platform.name',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'آیکون سایت',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.main-icon',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'ترکیب رنگ نوار بالایی',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.navbar-type',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'ترکیب رنگ نوار پایینی',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.navbar-bottm-type',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'آدرس سیستم مدیریت سیستم',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.admin-route',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'صفحه ورود پیشفرض',
            'category_id' => '1',
            'description' => 'پس از اینکه کاربر وارد یا در سایت ثبت نام کرد به چه صفحه ای برود.',
            'key' => 'platform.redirectTo',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'کلاس محتوایی',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.main-container',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'کلاس محتوایی نوار بالا و پایین',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.navbar-container',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'مدت زمان گش',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.cache-time',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'فعال بودن ثبت نام',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.enable-register',
            'type' => 'enable',
        ]);
        DB::table('settings')->insert([
            'title' => 'نوع موقعیت نوار بالایی',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.header-position',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'نوع موقعیت نوار پایینی',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.footer-position',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'انواع دسته بندی',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.category-type',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'صفحه فرود یا اولیه',
            'category_id' => '3',
            'description' => '',
            'key' => 'platform.index-page-id',
            'type' => 'select-table',
            'options' => 'pages,title'
        ]);
        DB::table('settings')->insert([
            'title' => 'صفحه ارتباط با ما',
            'category_id' => '3',
            'description' => '',
            'key' => 'platform.contact-us-page-id',
            'type' => 'select-table',
            'options' => 'pages,title'
        ]);
        DB::table('settings')->insert([
            'title' => 'صفحه درباره ما',
            'category_id' => '3',
            'description' => '',
            'key' => 'platform.about-us-page-id',
            'type' => 'select-table',
            'options' => 'pages,title'
        ]);
        DB::table('settings')->insert([
            'title' => 'مدیر اصلی سایت',
            'category_id' => '1',
            'description' => '',
            'key' => 'platform.main-admin-user-id',
            'type' => 'select-table',
            'options' => 'users,name'
        ]);
        DB::table('settings')->insert([
            'title' => 'فعال بودن فیش بانکی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.receipt.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به فیش بانکی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.receipt.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title'
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه فیش بانکی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.receipt.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'فعال بودن زرین پال',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.zarinpal.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به زرین پال',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.zarinpal.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title'
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه زرین پال',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.zarinpal.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'Merchant ID زرین پال',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.zarinpal.merchant-id',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'نوع درگاه زرین پال',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.zarinpal.type',
            'type' => 'select',
            'options' => 'zarin-gate,normal'
        ]);
        DB::table('settings')->insert([
            'title' => 'سرور زرین پال',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.zarinpal.server',
            'type' => 'select',
            'options' => 'germany,iran,test',
        ]);
        DB::table('settings')->insert([
            'title' => 'فعال بودن درگاه به پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.mellat.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به درگاه به پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.mellat.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه به پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.mellat.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'نام کاربری به پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.mellat.username',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'کلمه عبور به پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.mellat.password',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'شماره ترمینال به پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.mellat.terminalId',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'فعال بودن درگاه سامان کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saman.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به درگاه سامان کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saman.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه سامان کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saman.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'Merchant سامان کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saman.merchant',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'Password سامان کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saman.password',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'فعال بودن مبنا کارت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saderat.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به مبنا کارت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saderat.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه منبا کارت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saderat.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'Merchant مبنا کارت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saderat.merchant-id',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'Terminal مبنا کارت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saderat.terminal-id',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'کلید عمومی مبنا کارت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saderat.public-key',
            'type' => 'file',
        ]);
        DB::table('settings')->insert([
            'title' => 'کلید خصوصی مبنا کارت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.saderat.private-key',
            'type' => 'file',
        ]);

        DB::table('settings')->insert([
            'title' => 'فعال بودن ایران کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.irankish.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه ایران کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.irankish.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به ایران کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.irankish.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'Merchant ID ایران کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.irankish.merchant-id',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'SHA1 KEY ایران کیش',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.irankish.sha1-key',
            'type' => 'text-ltr',
        ]);



        DB::table('settings')->insert([
            'title' => 'فعال بودن Payir',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.payir.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به Payir',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.payir.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه Payir',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.payir.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'API Payir',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.payir.api',
            'type' => 'text-ltr',
        ]);


        DB::table('settings')->insert([
            'title' => 'فعال بودن سداد ملی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.sadad.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به سداد ملی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.sadad.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه سداد ملی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.sadad.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'شماره Merchant سداد ملی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.sadad.merchant',
            'type' => 'text-ltr',
        ]);

        DB::table('settings')->insert([
            'title' => 'کلید تراکنش سداد ملی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.sadad.transactionKey',
            'type' => 'text-ltr',
        ]);

        DB::table('settings')->insert([
            'title' => 'Terminal ID سداد ملی',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.sadad.terminalId',
            'type' => 'text-ltr',
        ]);



        DB::table('settings')->insert([
            'title' => 'فعال بودن آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.asanpardakht.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.asanpardakht.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.asanpardakht.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'شماره Merchant آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.sadad.merchantId',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'شماره Merchant Config آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.asanpardakht.merchantConfigId',
            'type' => 'text-ltr',
        ]);

        DB::table('settings')->insert([
            'title' => 'نام کاربری آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.asanpardakht.username',
            'type' => 'text-ltr',
        ]);

        DB::table('settings')->insert([
            'title' => 'کلمه عبور آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.asanpardakht.password',
            'type' => 'text-ltr',
        ]);

        DB::table('settings')->insert([
            'title' => 'کلید آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.asanpardakht.key',
            'type' => 'text-ltr',
        ]);

        DB::table('settings')->insert([
            'title' => 'IV آسان پرداخت',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.asanpardakht.iv',
            'type' => 'text-ltr',
        ]);



        DB::table('settings')->insert([
            'title' => 'فعال بودن پارسیان',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.parsian.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به پارسیان',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.parsian.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه پارسیان',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.parsian.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'PIN پارسیان',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.parsian.pin',
            'type' => 'text-ltr',
        ]);



        DB::table('settings')->insert([
            'title' => 'فعال بودن پاسارگاد',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.pasargad.enable',
            'type' => 'yesno',
        ]);
        DB::table('settings')->insert([
            'title' => 'حساب متصل به پاسارگاد',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.pasargad.account_id',
            'type' => 'select-table',
            'options' => 'accounts,title',
        ]);
        DB::table('settings')->insert([
            'title' => 'عنوان درگاه پاسارگاد',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.pasargad.title',
            'type' => 'text',
        ]);
        DB::table('settings')->insert([
            'title' => 'Terminal ID پاسارگاد',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.pasargad.terminalId',
            'type' => 'text-ltr',
        ]);
        DB::table('settings')->insert([
            'title' => 'Merchant ID پاسارگاد',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.pasargad.merchantId',
            'type' => 'text-ltr',
        ]);

        DB::table('settings')->insert([
            'title' => 'Certificate پاسارگاد',
            'category_id' => '2',
            'description' => '',
            'key' => 'gateway.pasargad.certificate-path',
            'type' => 'file',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
