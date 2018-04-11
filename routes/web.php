<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', 'HomeController@index')->name('index');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/home', 'DashboardController@index')->name('home');

Route::get('/dashboard/tickets', 'DashboardController@index')->name('dashboard.tickets');
Route::get('/dashboard/invoices', 'DashboardController@invoices')->name('dashboard.invoices');
Route::get('/dashboard/discussions', 'DashboardController@discussions')->name('dashboard.discussions');
Route::get('/dashboard/transactions', 'DashboardController@transactions')->name('dashboard.transactions');
Route::get('/dashboard/tiles', 'DashboardController@tiles')->name('dashboard.tiles');

Route::get('/verify', 'UserController@verify')->name('verify');
Route::get('/profile', 'UserController@profile')->name('profile');
Route::get('/password', 'UserController@password')->name('password');
Route::post('/password', 'UserController@updatePassword')->name('password');
Route::post('/profile', 'UserController@updateProfile')->name('profile');
Route::post('/information', 'UserController@updateInformation')->name('information');

Route::post('/verify/id_card', 'UserController@verifyIdCard')->name('verify.id_card');
Route::post('/verify/national_card', 'UserController@verifyNationalCard')->name('verify.national_card');

Route::get('/page/{id}', 'PageController@index')->name('page');
Route::get('/page/{id}/{slug}', 'PageController@slug')->name('page-slug');
Route::get('/about-us', 'PageController@aboutUs')->name('about-us');
Route::get('/contact-us', 'PageController@contactUs')->name('contact-us');


Route::get('/free-pay', 'FreePayController@index')->name('free-pay');
Route::get('/remote/{id}/{amount}', 'FreePayController@remote')->name('free-pay.remote');
Route::get('/r/{id}/{amount}', 'FreePayController@remote')->name('free-pay.r');
Route::post('/free-pay/start', 'FreePayController@start')->name('free-pay.start');
Route::any('/free-pay/callback', 'FreePayController@callback')->name('free-pay.callback');

Route::get('transaction', 'TransactionController@index')->name('transaction');
Route::get('transaction/view/{id}', 'TransactionController@view')->name('transaction.view');


Route::get('/invoice', 'InvoiceController@index')->name('invoice')->middleware('auth');
Route::get('/invoice/view/{id}', 'InvoiceController@view')->name('invoice.view')->middleware('auth');
Route::get('/invoice/view/{id}/{password}', 'InvoiceController@viewPassword')->name('invoice.view-password');
Route::post('/invoice/pay', 'InvoiceController@pay')->name('invoice.pay')->middleware('auth');
Route::post('/invoice/pay/{password}', 'InvoiceController@payPassword')->name('invoice.pay-password');
Route::get('/invoice/pay-link/{id}', 'InvoiceController@payLink')->name('invoice.pay-link')->middleware('auth');
Route::get('/invoice/pay-link/{id}/{password}', 'InvoiceController@payLinkPassword')->name('invoice.pay-link-password');
Route::any('/invoice/callback/{id}', 'InvoiceController@callback')->name('invoice.callback');
Route::any('/invoice/callback/{id}/{password}', 'InvoiceController@callbackPassword')->name('invoice.callback-password');

Route::get('/item/view/{id}', 'ItemController@view')->name('item.view');

Route::get('/file', 'FileController@index')->name('file');
Route::get('/file/category/{id}', 'FileController@category')->name('file.category');
Route::get('/file/type/{type}', 'FileController@type')->name('file.type');
Route::get('/file/create', 'FileController@create')->name('file.create')->middleware('auth');
Route::post('/file/insert', 'FileController@insert')->name('file.insert')->middleware('auth');
Route::post('/file/update/{id}', 'FileController@update')->name('file.update')->middleware('auth');
Route::delete('/file/delete/{id}', 'FileController@delete')->name('file.delete')->middleware('auth');
Route::get('/file/view/{id}', 'FileController@view')->name('file.view');
Route::get('/file/edit/{id}', 'FileController@edit')->name('file.edit')->middleware('auth');
Route::get('/file/view/{id}/{slug}', 'FileController@slug')->name('file.slug');
Route::get('/file/add-cart/{id}', 'FileController@addCart')->name('file.add-cart');
Route::get('/file/remove-cart/{id}', 'FileController@removeCart')->name('file.remove-cart');
Route::get('/file/download/{id}', 'FileController@download')->name('file.download')->middleware('auth');
Route::get('/file/download/{id}/{version_id}', 'FileController@downloadVersion')->name('file.download-version')->middleware('auth');
Route::get('/file-version/create/{id}', 'FileVersionController@create')->name('file-version.create')->middleware('auth');
Route::post('/file-version/insert/{id}', 'FileVersionController@insert')->name('file-version.insert')->middleware('auth');


Route::get('/article', 'ArticleController@index')->name('article');
Route::get('/article/{id}', 'ArticleController@view')->name('article.view');
Route::get('/article/{id}/{slug}', 'ArticleController@view')->name('article.slug');
Route::get('/articles/json', 'ArticleController@json')->name('article.json.last');


Route::get('/notification', 'NotificationController@index')->name('notification');
Route::get('/notification/view/{id}', 'NotificationController@view')->name('notification.view');
Route::get('/notification/count-unread', 'NotificationController@countUnread')->name('notification.count-unread');
Route::get('/notification/get-unread', 'NotificationController@getUnread')->name('notification.get-unread');

Route::get('/ticket', 'TicketController@index')->name('ticket')->middleware('auth');
Route::get('/ticket/create', 'TicketController@create')->name('ticket.create')->middleware('auth');
Route::post('/ticket/insert', 'TicketController@insert')->name('ticket.insert')->middleware('auth');
Route::post('/ticket/replay/{id}', 'TicketController@replay')->name('ticket.replay')->middleware('auth');
Route::get('/ticket/view/{id}', 'TicketController@view')->name('ticket.view')->middleware('auth');

Route::get('/item', 'ItemController@index')->name('item');

Route::get('/forum', 'DiscussionController@index')->name('forum');
Route::get('/discussion', 'DiscussionController@index')->name('discussion');
Route::get('/discussion/create', 'DiscussionController@create')->name('discussion.create')->middleware('auth');
Route::post('/discussion/insert', 'DiscussionController@insert')->name('discussion.insert')->middleware('auth');
Route::post('/discussion/post/{id}', 'DiscussionController@post')->name('discussion.post')->middleware('auth');
Route::get('/discussion/view/{id}', 'DiscussionController@view')->name('discussion.view');
Route::get('/discussion/category/{id}', 'DiscussionController@category')->name('discussion.category');

Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout');
Route::get('/cart/order', 'CartController@order')->name('cart.order');
Route::get('/cart/category/{id}', 'CartController@category')->name('cart.category');

Route::post('/cart/add-cart', 'CartController@addCart')->name('cart.add-cart');
Route::get('/cart/remove-cart/{id}', 'CartController@removeCart')->name('cart.remove-cart');

Route::post('/image-upload', 'ImageController@upload')->name('image-upload');
Route::get('/image/{folder}/{img}', 'ImageController@view')->name('image-view');


Route::get('/gateway', 'GatewayController@index')->name('gateway')->middleware('auth');
Route::get('/gateway/create', 'GatewayController@create')->name('gateway.create')->middleware('auth');

Route::get('/card', 'CardController@index')->name('card')->middleware('auth');
Route::get('/card/create', 'CardController@create')->name('card.create')->middleware('auth');

Route::prefix(Config('platform.admin-route'))->name('admin.')->group(function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/tiles', 'Admin\DashboardController@tiles')->name('dashboard.tiles');
    Route::get('/dashboard/incomes', 'Admin\DashboardController@incomes')->name('dashboard.incomes');
    Route::get('/dashboard/expenses', 'Admin\DashboardController@expenses')->name('dashboard.expenses');
    Route::get('/dashboard/news', 'Admin\DashboardController@news')->name('dashboard.news');
    Route::get('/dashboard/tickets', 'Admin\DashboardController@tickets')->name('dashboard.tickets');

    Route::get('/user', 'Admin\UserController@index')->name('user');
    Route::get('/user/data', 'Admin\UserController@data')->name('user.data');
    Route::get('/user/edit/{id}', 'Admin\UserController@edit')->name('user.edit');
    Route::post('/user/update/{id}', 'Admin\UserController@update')->name('user.update');
    Route::get('/user/create', 'Admin\UserController@create')->name('user.create');
    Route::post('/user/insert', 'Admin\UserController@insert')->name('user.insert');
    Route::delete('/user/delete/{id}', 'Admin\UserController@delete')->name('user.delete');

    Route::get('/page', 'Admin\PageController@index')->name('page');
    Route::get('/page/data', 'Admin\PageController@data')->name('page.data');
    Route::get('/page/edit/{id}', 'Admin\PageController@edit')->name('page.edit');
    Route::post('/page/update/{id}', 'Admin\PageController@update')->name('page.update');
    Route::get('/page/create', 'Admin\PageController@create')->name('page.create');
    Route::post('/page/insert', 'Admin\PageController@insert')->name('page.insert');
    Route::delete('/page/delete/{id}', 'Admin\PageController@delete')->name('page.delete');


    Route::get('/article', 'Admin\ArticleController@index')->name('article');
    Route::get('/article/data', 'Admin\ArticleController@data')->name('article.data');
    Route::get('/article/edit/{id}', 'Admin\ArticleController@edit')->name('article.edit');
    Route::post('/article/update/{id}', 'Admin\ArticleController@update')->name('article.update');
    Route::get('/article/create', 'Admin\ArticleController@create')->name('article.create');
    Route::post('/article/insert', 'Admin\ArticleController@insert')->name('article.insert');
    Route::delete('/article/delete/{id}', 'Admin\ArticleController@delete')->name('article.delete');

    Route::get('/transaction', 'Admin\TransactionController@index')->name('transaction');
    Route::get('/transaction/create/income', 'Admin\TransactionController@createIncome')->name('transaction.create.income');
    Route::get('/transaction/create/expense', 'Admin\TransactionController@createExpense')->name('transaction.create.expense');
    Route::post('/transaction/insert', 'Admin\TransactionController@insert')->name('transaction.insert');
    Route::post('/transaction/update/{id}', 'Admin\TransactionController@update')->name('transaction.update');
    Route::get('/transaction/edit/income/{id}', 'Admin\TransactionController@editIncome')->name('transaction.edit.income');
    Route::get('/transaction/edit/expense/{id}', 'Admin\TransactionController@editExpense')->name('transaction.edit.expense');
    Route::delete('/transaction/delete/{id}', 'Admin\TransactionController@delete')->name('transaction.delete');


    Route::get('/item', 'Admin\ItemController@index')->name('item');
    Route::get('/item/data', 'Admin\ItemController@data')->name('item.data');
    Route::get('/item/edit/{id}', 'Admin\ItemController@edit')->name('item.edit');
    Route::get('/item/inventory/{id}', 'Admin\ItemController@inventory')->name('item.inventory');
    Route::post('/item/update/{id}', 'Admin\ItemController@update')->name('item.update');
    Route::get('/item/create', 'Admin\ItemController@create')->name('item.create');
    Route::post('/item/insert', 'Admin\ItemController@insert')->name('item.insert');
    Route::delete('/item/delete/{id}', 'Admin\ItemController@delete')->name('item.delete');


    Route::get('/invoice', 'Admin\InvoiceController@index')->name('invoice');
    Route::get('/invoice/view/{id}', 'Admin\InvoiceController@view')->name('invoice.view');
    Route::get('/invoice/create/purchase', 'Admin\InvoiceController@createPurchase')->name('invoice.create.purchase');
    Route::get('/invoice/create/sale', 'Admin\InvoiceController@createSale')->name('invoice.create.sale');
    Route::get('/invoice/create/user/{id}', 'Admin\InvoiceController@createUserInvoice')->name('invoice.create.user');
    Route::post('/invoice/insert', 'Admin\InvoiceController@insert')->name('invoice.insert');
    Route::post('/invoice/update/{id}', 'Admin\InvoiceController@update')->name('invoice.update');
    Route::post('/invoice/pay', 'Admin\InvoiceController@pay')->name('invoice.pay');

    Route::post('/invoice/calculate-total', 'Admin\InvoiceController@calculateTotal')->name('invoice.calculate-total');
    Route::get('/invoice/items', 'Admin\InvoiceController@items')->name('invoice.items');
    Route::post('/invoice/delete-record', 'Admin\InvoiceController@deleteRecord')->name('invoice.delete-record');
    Route::get('/invoice/edit/{id}', 'Admin\InvoiceController@edit')->name('invoice.edit');
    Route::delete('/invoice/delete/{id}', 'Admin\InvoiceController@delete')->name('invoice.delete');
    Route::get('/invoice/send/{id}', 'Admin\InvoiceController@sendInvoice')->name('invoice.send');


    Route::get('/account', 'Admin\AccountController@index')->name('account');
    Route::get('/account/data', 'Admin\AccountController@data')->name('account.data');
    Route::get('/account/edit/{id}', 'Admin\AccountController@edit')->name('account.edit');
    Route::post('/account/update/{id}', 'Admin\AccountController@update')->name('account.update');
    Route::get('/account/create', 'Admin\AccountController@create')->name('account.create');
    Route::post('/account/insert', 'Admin\AccountController@insert')->name('account.insert');
    Route::delete('/account/delete/{id}', 'Admin\AccountController@delete')->name('account.delete');



    Route::get('/category', 'Admin\CategoryController@index')->name('category');
    Route::get('/category/data', 'Admin\CategoryController@data')->name('category.data');
    Route::get('/category/edit/{id}', 'Admin\CategoryController@edit')->name('category.edit');
    Route::post('/category/update/{id}', 'Admin\CategoryController@update')->name('category.update');
    Route::get('/category/create', 'Admin\CategoryController@create')->name('category.create');
    Route::post('/category/insert', 'Admin\CategoryController@insert')->name('category.insert');
    Route::delete('/category/delete/{id}', 'Admin\CategoryController@delete')->name('category.delete');


    Route::get('/setting', 'Admin\SettingController@index')->name('setting');
    Route::get('/setting/category/{id}', 'Admin\SettingController@category')->name('setting.category');
    Route::post('/setting/category/update/{id}', 'Admin\SettingController@updateCategory')->name('setting.category.update');
    Route::get('/setting/edit/{id}', 'Admin\SettingController@edit')->name('setting.edit');
    Route::post('/setting/update/{id}', 'Admin\SettingController@update')->name('setting.update');
    Route::get('/setting/create', 'Admin\SettingController@create')->name('setting.create');
    Route::post('/setting/insert', 'Admin\SettingController@insert')->name('setting.insert');
    Route::delete('/setting/delete/{id}', 'Admin\SettingController@delete')->name('setting.delete');

    Route::get('/app', 'Admin\AppController@index')->name('app');
});