<?php
/**
 * Created by PhpStorm.
 * User: Ali Ghasemzadeh
 * Date: 3/16/2018
 * Time: 1:37 PM
 */
Route::get('/bot/updates', 'BotController@getUpdates')->name('bot-updates')->middleware('admin');
Route::get('/bot/set-webhook', 'BotController@setWebhook')->name('bot-set-webhook')->middleware('admin');
Route::get('/bot/remove-webhook', 'BotController@removeWebhook')->name('bot-remove-webhook')->middleware('admin');
Route::post('/bot/webhook', 'BotController@webhookHandler')->name('bot-webhook');
