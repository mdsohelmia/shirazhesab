<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Shirazsoft\Gateway\Gateway;
use Shirazsoft\Gateway\Irankish\IrankishException;
use Shirazsoft\Gateway\Payir\PayirSendException;
use Shirazsoft\Gateway\Saderat\SaderatException;
use Shirazsoft\Gateway\Sadad\SadadException;
use Shirazsoft\Gateway\Mellat\MellatException;
use Shirazsoft\Gateway\Saman\SamanException;
use Shirazsoft\Gateway\Zarinpal\ZarinpalException;
use Shirazsoft\Gateway\Pasargad\PasargadErrorException;
use Shirazsoft\Gateway\Parsian\ParsianErrorException;
use Shirazsoft\Gateway\Paypal\PaypalException;
use Shirazsoft\Gateway\Payir\PayirReceiveException;
use Shirazsoft\Gateway\JahanPay\JahanPayException;
use Shirazsoft\Gateway\Exceptions\RetryException;
use Shirazsoft\Gateway\Exceptions\PortNotFoundException;
use Shirazsoft\Gateway\Exceptions\InvalidRequestException;
use Shirazsoft\Gateway\Exceptions\NotFoundTransactionException;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function user()
    {

    }

    public function userCallback(Request $request)
    {

    }

    public function index(Request $request)
    {
        $gateway = \App\Gateway::find($request->gateway_id);
        if($gateway) {
            $string = $gateway->id .",". $gateway->payment_password .",". $request->amount .",". $request->gateway_order_id ."," . $request->gateway_callback .",". $request->description;
            if(password_verify($string, $request->hash)) {
                $transaction = Transaction::ofGateway($gateway->id)->where('gateway_order_id', $request->gateway_order_id);
                if($transaction->first()) {
                    return view('payment.error',['code'=> '3', 'message' => 'تراکنش پیشتر پرداخت شده است.','gateway_callback' => $request->gateway_callback]);
                } else {
                    if($request->amount < config('platform.min-payment-price')) {
                        return view('payment.error',['code'=> '4', 'message' => 'مبلغ تراکنش کمتر از حد مجاز است.','gateway_callback' => $request->gateway_callback]);
                    } else {
                        try {

                            $request_gateway = $gateway->gateway;
                            $bank_gateway = Gateway::{$request_gateway}();
                            $bank_gateway->setCallback(url('payment/callback'));
                            $bank_gateway->price($request->amount * 10)->ready();
                            $refId =  $bank_gateway->refId();
                            $transID = $bank_gateway->transactionId();

                            session(['description' => $request->description]);
                            session(['gateway' => $request_gateway]);
                            session(['gateway_id' => $gateway->id]);
                            session(['amount' => $request->amount]);
                            session(['gateway_order_id' => $request->gateway_order_id]);
                            session(['gateway_callback' => $request->gateway_callback]);

                            return $bank_gateway->redirect();
                        } catch (Exception $e) {
                            $bank_error = $e->getMessage();
                        }catch (IrankishException $e) {
                            $bank_error = $e->getMessage();
                        } catch (SaderatException $e) {
                            $bank_error = $e->getMessage();
                        } catch (PayirSendException $e) {
                            $bank_error = $e->getMessage();
                        } catch (SadadException $e) {
                            $bank_error = $e->getMessage();
                        } catch (MellatException $e) {
                            $bank_error = $e->getMessage();
                        } catch (SamanException $e) {
                            $bank_error = $e->getMessage();
                        } catch (ZarinpalException $e) {
                            $bank_error = $e->getMessage();
                        } catch (PasargadErrorException $e) {
                            $bank_error = $e->getMessage();
                        } catch (ParsianErrorException $e) {
                            $bank_error = $e->getMessage();
                        } catch (PaypalException $e) {
                            $bank_error = $e->getMessage();
                        } catch (JahanPayException $e) {
                            $bank_error = $e->getMessage();
                        }
                        return view('payment.error',['code'=> '5', 'message' => $bank_error,'gateway_callback' => $request->gateway_callback]);
                    }
                }

            } else {
                return view('payment.error',['code'=> '2', 'message' => 'رمز وارد شده اشتباه است.','gateway_callback' => $request->gateway_callback]);
            }
        } else {
            return view('payment.error',['code'=> '1', 'message' => 'چنین درگاهی وجود ندارد.','gateway_callback' => $request->gateway_callback]);
        }
    }

    public function callback(Request $request)
    {
        try {
            $gateway = \App\Gateway::find(session('gateway_id'));
            $bank_gateway = \Gateway::verify();
            $trackingCode = $bank_gateway->trackingCode();

            $transaction = new Transaction();
            $transaction->account_id = config('gateway.'.session('gateway').'.account_id');
            $transaction->gateway = session('gateway');
            $transaction->gateway_id = session('gateway_id');
            $transaction->user_id = $gateway->user_id;
            $transaction->amount = session('amount');
            $transaction->description = session('description');
            $transaction->category_id = config('platform.payment-category-id');
            $transaction->transaction_at = date("Y-m-d H:i:s");
            $transaction->gateway_order_id = session('gateway_order_id');
            $transaction->save();

            $string = $gateway->id .",". $gateway->callback_password . "," . session('gateway_order_id') ."," . $trackingCode;
            $hash =  password_hash($string,PASSWORD_DEFAULT);
            if($gateway->callback_hook) {
                try {
                    $client = new Client();
                    $response =$client->postAsync($gateway->callback_hook, [
                        'form_params' => [
                            'code' => '0',
                            'message' => 'پرداخت با موفقیت انجام شد.',
                            'gateway_id' => $gateway->id ,
                            'tracking_code' => $trackingCode,
                            'hash' => $hash,
                            'gateway_order_id' => session('gateway_order_id')
                        ]
                    ]);
                    $response->wait();
                } catch (Exception $e) {}

            }
            return view('payment.callback',['gateway_id'=> $gateway->id ,'tracking_code' => $trackingCode,'code'=>'0','message'=>'پرداخت با موفقیت انجام شد.','hash'=>$hash,'gateway_callback' => session('gateway_callback'),'gateway_order_id' =>  session('gateway_order_id')]);
        } catch (Exception $e) {
            $bank_error = $e->getMessage();
        } catch (IrankishException $e) {
            $bank_error = $e->getMessage();
        } catch (SaderatException $e) {
            $bank_error = $e->getMessage();
        } catch (PayirReceiveException $e) {
            $bank_error = $e->getMessage();
        } catch (SadadException $e) {
            $bank_error = $e->getMessage();
        } catch (MellatException $e) {
            $bank_error = $e->getMessage();
        } catch (SamanException $e) {
            $bank_error = $e->getMessage();
        } catch (ZarinpalException $e) {
            $bank_error = $e->getMessage();
        } catch (PasargadErrorException $e) {
            $bank_error = $e->getMessage();
        } catch (ParsianErrorException $e) {
            $bank_error = $e->getMessage();
        } catch (PaypalException $e) {
            $bank_error = $e->getMessage();
        } catch (JahanPayException $e) {
            $bank_error = $e->getMessage();
        }catch (RetryException $e) {
            $bank_error = $e->getMessage();
        } catch (PortNotFoundException $e) {
            $bank_error = $e->getMessage();
        } catch (InvalidRequestException $e) {
            $bank_error = $e->getMessage();
        } catch (NotFoundTransactionException $e) {
            $bank_error = $e->getMessage();
        }
        return view('payment.error',['code'=> '5', 'message' => $bank_error,'gateway_callback' => session('gateway_callback')]);
    }

    public function check($api_key, $id)
    {
        $gateway = \App\Gateway::where('api_key', $api_key);
        if($gateway->first()) {
            $gateway = $gateway->first();
            $transaction = Transaction::ofGateway($gateway->id)->where('gateway_order_id', $id);
            if($transaction->first()) {
                $messageBag =
                    [
                        'code' => '0',
                        'message' => 'پرداخت با موفقیت انجام شده است.'
                    ];
                return response()->json($messageBag);
            } else {
                $messageBag =
                    [
                        'code' => '6',
                        'message' => 'قابلیت پرداخت این شماره وجود دارد.'
                    ];
                return response()->json($messageBag);
            }
        } else {
            $messageBag =
                [
                    'code' => '1',
                    'message' => 'چنین درگاهی وجود ندارد.'
                ];
            return response()->json($messageBag);
        }
    }
}
