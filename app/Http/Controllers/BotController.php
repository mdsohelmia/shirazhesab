<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Support\Facades\Hash;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;
use App\User;
use App\LastMessage;

/**
 * Class BotController
 */
class BotController extends Controller
{
    /**
     * Get updates from Telegram.
     */
    public function getUpdates()
    {
        dd(Telegram::getUpdates());
    }

    /**
     * Set a webhook.
     */
    public function setWebhook()
    {
        $url = route('bot-webhook');
        $response = Telegram::setWebhook(['url' => $url]);
        dd($response);
    }

    /**
     * Remove webhook.
     *
     * @return array
     */
    public function removeWebhook()
    {
        $response = Telegram::removeWebhook();
        dd($response);
    }

    /**
     * Handles incoming webhook updates from Telegram.
     *
     * @return string
     */
    public function webhookHandler()
    {
        $update = Telegram::commandsHandler(true);
        $message = $update->getMessage();
        if($lastMessage = $this->getLastMessage($message->chat->id)) {
            if($lastMessage->command == 'guest.name') {
                $info = ['name' => $message->text];
                Telegram::sendMessage([
                    'chat_id' => $message->chat->id,
                    'text' => "شماره همراه:"
                ]);
                $this->setLastMessage($message->chat->id, $info,'guest.phone');
            }

            if($lastMessage->command == 'guest.phone') {
                if(is_numeric(en_numbers($message->text))) {
                    $user = User::where('mobile',en_numbers($message->text));
                    if($user->first()) {
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => "شماره همراه شما قبلا ثبت شده است لطفا از طریق فعال سازی وارد شوید."
                        ]);
                        $keyboard = Keyboard::make()
                            ->forceReply()
                            ->row(Keyboard::inlineButton(['text' => '*فعال سازی', 'callback_data' => 'guest.active']), Keyboard::inlineButton(['text' => '*ثبت نام', 'callback_data' => 'guest.register']));
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => 'سلام پیش از استفاده از سیستم نیاز است شما ثبت نام یا فعال سازی را انجام دهید. ',
                            'reply_markup' => $keyboard
                        ]);
                        $this->setLastMessage($message->chat->id, '','guest.menu');
                    } else {
                        $info = $lastMessage->message;
                        $info = [
                            'mobile' => en_numbers($message->text),
                            'name' => $info['name']
                        ];
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => "اطلاعات وارد شده شما" . "\n" . "نام و نام خانوادگی:" . $info['name'] . "\n" . "شماره همراه:" . $info['mobile']
                        ]);
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => "ایمیل خود را وارد کنید:"
                        ]);
                        $this->setLastMessage($message->chat->id, $info,'guest.email');
                    }
                } else {
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => "شماره همراه وارد شده اشتباه است، شماره وارد شده باید عدد باشد و ثبت نام نشده باشد، در صورتی که قبلا ثبت نام کردید به صفحه مشخصات فردی بروید و کد فعال سازی را وارد کنید."
                    ]);
                }
            }

            if($lastMessage->command == 'guest.email') {
                if (filter_var($message->text, FILTER_VALIDATE_EMAIL)) {
                    $user = User::where('email',$message->text);
                    if($user->first()) {
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => "ایمیل وارد شده قبلا ثبت شده است، لطفا از طریق فعال سازی اقدام کنید."
                        ]);
                        $keyboard = Keyboard::make()
                            ->forceReply()
                            ->row(Keyboard::inlineButton(['text' => '*فعال سازی', 'callback_data' => 'guest.active']), Keyboard::inlineButton(['text' => '*ثبت نام', 'callback_data' => 'guest.register']));
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => 'سلام پیش از استفاده از سیستم نیاز است شما ثبت نام یا فعال سازی را انجام دهید. ',
                            'reply_markup' => $keyboard
                        ]);
                        $this->setLastMessage($message->chat->id, '','guest.menu');
                    } else {
                        $info = $lastMessage->message;
                        $info = [
                            'email' => $message->text,
                            'mobile' => $info['mobile'],
                            'name' => $info['name']
                        ];

                        $user = new User();
                        $user->name = $info['name'];
                        $user->mobile = $info['mobile'];
                        $user->email = $info['email'];
                        $user->telegram_user_id = $message->chat->id;
                        $user->password = Hash::make($message->chat->id);
                        $user->save();

                        $user->telegram_password = $user->id . rand(1,9) . rand(100,999);
                        $user->save();

                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => "اطلاعات وارد شده شما" . "\n" . "نام و نام خانوادگی:" . $info['name'] . "\n" . "شماره همراه:" . $info['mobile']. "\n" . "ایمیل:" . $info['email']. "\n" . "کلمه عبور:" . $user->telegram_user_id. "\n" . "کد فعال ساز تلگرام:" . $user->telegram_password
                        ]);

                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => "ثبت نام شما با موفقیت انجام شد."
                        ]);
                        Telegram::sendMessage([
                            'chat_id' => $user->telegram_user_id,
                            'text' => $user->name .  " عزیز خوش آمدید، هم اکنون می توانید از امکانات ربات استفاده کنید.",
                        ]);
                        $keyboard = Keyboard::make()
                            ->forceReply()
                            ->row(Keyboard::inlineButton(['text' => '*پرداخت وجه', 'callback_data' => 'register.free_pay']), Keyboard::inlineButton(['text' => '*صورت حساب ها', 'callback_data' => 'register.invoice']));
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => 'شما می توانید یکی از کارهای زیر را انجام دهید.',
                            'reply_markup' => $keyboard
                        ]);
                        $this->setLastMessage($message->chat->id, '','registered.menu');
                    }
                } else {
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => "لطفا یک ایمیل معتبر وارد نمایید."
                    ]);
                }
            }

            if($lastMessage->command == 'register.free_pay') {
                if(is_numeric(en_numbers($message->text)) && $message->text > 1000) {
                    $user = User::where('telegram_user_id', $message->chat->id)->first();
                    $url = route('free-pay.remote', [$user->id, en_numbers($message->text)]);
                    $keyboard = Keyboard::make()
                        ->inline()
                        ->row(Keyboard::inlineButton(['text' => 'پرداخت مبلغ', 'callback_data' => 'register.pay_link', 'url'=> $url]));

                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => 'پرداخت وجه:' . $message->text,
                        'reply_markup' => $keyboard
                    ]);


                    $keyboard = Keyboard::make()
                        ->forceReply()
                        ->row(Keyboard::inlineButton(['text' => '*پرداخت وجه', 'callback_data' => 'register.free_pay']), Keyboard::inlineButton(['text' => '*صورت حساب ها', 'callback_data' => 'register.invoice']));
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => 'شما می توانید یکی از کارهای زیر را انجام دهید.',
                        'reply_markup' => $keyboard
                    ]);
                    $this->setLastMessage($message->chat->id, '','registered.menu');

                } else {
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => 'مبلغ وارد شده اشتباه است،مبلغ باید عددی و مثبت باشد.',
                    ]);
                }

            }
            if($lastMessage->command == 'guest.active') {
                $user = User::where('telegram_password', $message->text);
                if($user->count() > 0) {
                    $user = $user->first();
                    $user->telegram_user_id = $message->chat->id;
                    $user->save();
                    Telegram::sendMessage([
                        'chat_id' => $user->telegram_user_id,
                        'text' => $user->name .  " عزیز خوش آمدید، هم اکنون می توانید از امکانات ربات استفاده کنید.",
                    ]);
                    $keyboard = Keyboard::make()
                        ->forceReply()
                        ->row(Keyboard::inlineButton(['text' => '*پرداخت وجه', 'callback_data' => 'register.free_pay']), Keyboard::inlineButton(['text' => '*صورت حساب ها', 'callback_data' => 'register.invoice']));
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => 'شما می توانید یکی از کارهای زیر را انجام دهید.',
                        'reply_markup' => $keyboard
                    ]);
                    $this->setLastMessage($message->chat->id, '','registered.menu');
                } else {
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => "کد فعال سازی اشتباه وارد شده است لطفا آن را مجدد ارسال کنید.",
                    ]);
                }
            }

            if($message->text == '*فعال سازی') {
                if($lastMessage->command == 'guest.menu') {
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => "کد فعال سازی را از درون سایت در این قسمت کپی کنید.",
                    ]);
                    $this->setLastMessage($message->chat->id, '','guest.active');
                }
            }

            if($message->text == '*ثبت نام') {
                if($lastMessage->command == 'guest.menu') {
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => "نام و نام خانوادگی:",
                    ]);
                    $this->setLastMessage($message->chat->id, '','guest.name');
                }
            }

            if($message->text == '*صورت حساب ها') {
                if($lastMessage->command == 'registered.menu') {
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => "لیست صورت حساب های پرداخت نشده شما:",
                    ]);



                    $user = User::where('telegram_user_id', $message->chat->id)->first();
                    $invoices = Invoice::ofUser($user->id)->due()->get();
                    if($invoices->count() == 0) {
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => "شما صورت حسابی ندارید.",
                        ]);
                    } else {
                        Telegram::sendMessage([
                            'chat_id' => $message->chat->id,
                            'text' => "تعداد صورت حساب های شما:" . $invoices->count(),
                        ]);
                        foreach ($invoices as $invoice) {
                            $keyboard = Keyboard::make()
                                ->inline()
                                ->row(Keyboard::inlineButton(['text' => 'نمایش صورت حساب', 'url' => route('invoice.view-password',[$invoice->id,$invoice->password])]), Keyboard::inlineButton(['text' => 'پرداخت صورت حساب', 'url' => route('invoice.pay-link-password',[$invoice->id,$invoice->password])]));
                            Telegram::sendMessage([
                                'chat_id' => $message->chat->id,
                                'text' => "صورت حساب شماره:" . $invoice->id . " با مبلغ:" . $invoice->total,
                                'reply_markup' => $keyboard
                            ]);
                        }



                    }

                    $keyboard = Keyboard::make()
                        ->forceReply()
                        ->row(Keyboard::inlineButton(['text' => '*پرداخت وجه', 'callback_data' => 'register.free_pay']), Keyboard::inlineButton(['text' => '*صورت حساب ها', 'callback_data' => 'register.invoice']));
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => 'شما می توانید یکی از کارهای زیر را انجام دهید.',
                        'reply_markup' => $keyboard
                    ]);
                    $this->setLastMessage($message->chat->id, '','registered.menu');
                }
            }

            if($message->text == '*پرداخت وجه') {
                if($lastMessage->command == 'registered.menu') {
                    Telegram::sendMessage([
                        'chat_id' => $message->chat->id,
                        'text' => "مبلغ را به تومان وارد کنید:",
                    ]);
                    $this->setLastMessage($message->chat->id, '','register.free_pay');
                }
            }


        }
        if($message->text == "/start") {
            $user = User::where('telegram_user_id', $message->chat->id);
            if($user->count() > 0) {
                $user = $user->first();
                Telegram::sendMessage([
                    'chat_id' => $user->telegram_user_id,
                    'text' => $user->name .  " عزیز خوش آمدید، هم اکنون می توانید از امکانات ربات استفاده کنید.",
                ]);
                $keyboard = Keyboard::make()
                    ->forceReply()
                    ->row(Keyboard::inlineButton(['text' => '*پرداخت وجه', 'callback_data' => 'register.free_pay']), Keyboard::inlineButton(['text' => '*صورت حساب ها', 'callback_data' => 'register.invoice']));
                Telegram::sendMessage([
                    'chat_id' => $message->chat->id,
                    'text' => 'شما می توانید یکی از کارهای زیر را انجام دهید.',
                    'reply_markup' => $keyboard
                ]);
                $this->setLastMessage($message->chat->id, '','registered.menu');
            } else {
                $keyboard = Keyboard::make()
                    ->forceReply()
                    ->row(Keyboard::inlineButton(['text' => '*فعال سازی', 'callback_data' => 'guest.active']), Keyboard::inlineButton(['text' => '*ثبت نام', 'callback_data' => 'guest.register']));
                Telegram::sendMessage([
                    'chat_id' => $message->chat->id,
                    'text' => 'سلام پیش از استفاده از سیستم نیاز است شما ثبت نام یا فعال سازی را انجام دهید. ',
                    'reply_markup' => $keyboard
                ]);
                $this->setLastMessage($message->chat->id, '','guest.menu');
            }
        }


        if(env('APP_DEBUG') == 'true') {
            Telegram::sendMessage([
                'chat_id' => $message->chat->id,
                'text' => serialize($update),
            ]);
        }


        return 'Ok';
    }

    public function setLastMessage($chat_id, $message = "", $command = null)
    {
        if($lastMessage = LastMessage::find($chat_id)) {
            $lastMessage->id = $chat_id;
            $lastMessage->command = $command;
            $lastMessage->message = $message;
            $lastMessage->save();
        } else {
            $lastMessage = new LastMessage();
            $lastMessage->id = $chat_id;
            $lastMessage->command = $command;
            $lastMessage->message = $message;
            $lastMessage->save();
        }
        return $lastMessage;
    }

    public function getLastMessage($chat_id)
    {
        return LastMessage::find($chat_id);
    }
}